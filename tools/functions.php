<?php
include('validAcount.php'); // Assumes this validates user session or cookie

if (isset($_COOKIE['user'])) {
    // Global vars
    $user = str_replace(" ", "_", $_COOKIE['user']);
    $file = "../usuarios/$user/fav.txt";

    // Dynamically construct base URL
    $scheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $baseUrl = "$scheme://$host";

    // Database connection
    $hostDB = "sql305.infinityfree.com";
    $userH = "if0_39766672";
    $pass = "Guilleweb042";
    $DB = "if0_39766672_webAppUsers";
    $tabla = "publicacionesPS";

    $connect = mysqli_connect($hostDB, $userH, $pass, $DB);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Handle download action
    if (isset($_GET['desca']) && !empty($_GET['desca'])) {
        $id = mysqli_real_escape_string($connect, $_GET['desca']);
        
        // Query to get the image path (column 4, assuming 0-based index in comment)
        $query = "SELECT ruta FROM $tabla WHERE id = '$id'";
        $result = mysqli_query($connect, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $imagePath = $row['ruta'];
            $fullImageUrl = "$baseUrl/photoStory/$imagePath";
            
            // Increment download count (column 9, assuming 0-based index)
            $updateQuery = "UPDATE $tabla SET descargas = descargas + 1 WHERE id = '$id'";
            mysqli_query($connect, $updateQuery);
            
            // Return JSON response with image URL and updated download count
            $downloads = mysqli_fetch_assoc(mysqli_query($connect, "SELECT descargas FROM $tabla WHERE id = '$id'"))['descargas'];
            echo json_encode(['status' => 'success', 'imageUrl' => $fullImageUrl, 'downloads' => $downloads]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Post not found']);
        }
    }
    // Handle share action
    elseif (isset($_GET['share']) && !empty($_GET['share'])) {
        $id = mysqli_real_escape_string($connect, $_GET['share']);
        
        // Query to get the post title (column 2, assuming 0-based index)
        $query = "SELECT titulo FROM $tabla WHERE id = '$id'";
        $result = mysqli_query($connect, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['titulo'];
            $shareUrl = "$baseUrl/photoStory/?post=" . urlencode($title);
            
            // Increment share count (column 8, assuming 0-based index)
            $updateQuery = "UPDATE $tabla SET compartido = compartido + 1 WHERE id = '$id'";
            mysqli_query($connect, $updateQuery);
            
            // Return JSON response with share URL and updated share count
            $shares = mysqli_fetch_assoc(mysqli_query($connect, "SELECT compartido FROM $tabla WHERE id = '$id'"))['compartido'];
            echo json_encode(['status' => 'success', 'shareUrl' => $shareUrl, 'shares' => $shares]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Post not found']);
        }
    } else {
        //echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        echo print_r($_COOKIE);
    }

    mysqli_close($connect);
} else {
    // Redirect to login page using dynamic base URL
    $scheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
    $host = $_SERVER['HTTP_HOST'];
    header("Location: $scheme://$host/photoStory");
    exit();
}
?>