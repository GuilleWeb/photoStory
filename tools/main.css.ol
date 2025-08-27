*{
  user-select:none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -khtml-user-select: none;
  -ms-user-select:none;
  transition:.3s linear;
  box-sizing: border-box;
} 
span,label,button,input[type="submit"]{
  cursor: pointer;
}
progress{
  -webkit-appearance:none;
  appearance:none;
}
progress::-webkit-progress-bar{
  background: pink;
  border-radius: 2px;
  box-shadow: 0 2px 5px rgba(0,0,0,.25) inset;
}

progress::-webkit-progress-value{
  background:repeating-linear-gradient(120deg,#df0056,pink 10%, #df0056 20%);
  border-radius: 2px;
}
#publicSection{
  text-align: center;
  height: auto;
  border: 0;
  position: fixed;
  display: none;
  width: 270px;
  box-shadow: 0 0 15px gray;
  background: rgba(999,999,999,.5);
  z-index: 9;
}
#publicSection legend{
  cursor: move;
  background: white; 
  padding: 5px;
  box-shadow: 0 -5px 5px silver;
}
textarea{
  display: block;
  margin: auto;
  width:90%;
  height:150px;
  resize:none;
  border-radius: 5px;
  border: solid 1px silver;
    outline: 0;
}
#publicSection:hover{
  background:white;
}
@keyframes tras{
  from{
  width: 0px;height: 0px;
  background: #df0056;
  color: white;
  top: 90%;left: 90%;
  }
  to{
  width:150px;height: 100px;
  top:50px;left:50px;
  }
}
@keyframes trasOff{
  from{
  width:150px;height: 100px;
  background: #df0056;
  top: 50px;left: 50px;
  }
  to{
  width: 0px;height: 0px;
  top:90%;left:90%;
  }
}
#imgPrev{
  overflow: auto;
}
#imgPrev img{
  display: block;
  margin: auto;
  width: 80%;
  height: 200px;
  border-radius: 5px;
}
#unVerified{
  border-radius: 5px;
  display: block;
  margin: auto;
  border: solid 1px;
  width: auto;
  max-width: 95%;
  padding: 10px;
  position: fixed;
  bottom: 5px;
  left: 10%;
color: #df0056;
background: #ececec;
height: auto;
z-index: 9;
}
#unVerified #textoAlerta{
display: none;
}
#unVerified:hover{
background: #ececec;
  opacity: 1;
}
#unVerified:hover #textoAlerta{
  display: inline-table;
}
input[type="submit"]{
background: #df0056;color: white;
border:solid 2px rgba(999,999,999,.3);
border-radius: 5px;
outline: 0;
padding: 5px;
}
input[type="submit"]:active{
background: rgba(999,999,999,.3);
color: #df0056;
}
input[required]{
padding: 5px;
border:0;outline:0;
border-bottom:solid 2px silver;
}
input[required]:focus{
border-bottom:solid 2px #df0056;
}
#loadding{
  width: 100%;
  height: 50px;
  position: fixed;
  z-index: 15;
   bottom: 0;
  left: 0;
background: rgba(999,999,999,.8);
  color: #df0056;
text-align: center;
display: none;
}
.icon-notification{
  display: none;
}
.icon-toys{
  font-size: 20px;
  display: block;
  margin: auto;
  -webkit-animation: rotar 3s linear infinite;
  animation: rotar 3s linear infinite;
}
@keyframes rotar{
    100%{
    -ms-transform: rotate(360deg); /* IE 9 */
    -webkit-transform: rotate(1360deg); /* Safari */
    transform: rotate(360deg);
    }
}
#connectionOFF{

}
body {
 background: #ececec; 
}
header {
  width: 100%;
  min-height: auto;
  max-height: 10%;
  color: #FFF;
  padding-bottom: 5px;
  background: #4048af;
  position: fixed;
  top: 0;
  left: 0;
  box-shadow:0px 5px 5px rgba(0,0,0,.5);
  z-index: 9; 
}
.header .title{
  margin-left: 15px;
  font-size: 20px;
}
.button_header{
  position: fixed;
  right: 10px;
  top: 10px;
  z-index: 9; 
}
.button_header span{
  margin-left: 5px;
  cursor: pointer;
   background: transparent;
  border:0;outline: 0;
  color: white;
  font-size: 20px;
}
#seachDiv{
  border-radius: 5px;
  box-shadow: 0 5px 5px rgba(0,0,0,.5);
  text-align: center;
  width: auto;
  height: auto;
  padding:1% 1% 5% 1%;
  min-width:20%;
  overflow: hidden;
  z-index: 11;
  position: fixed;
  top:10%;
  right: 0px;
  background: #4048af;
}
nav{
  background: white;
  color: gray;
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  z-index: 10;
  overflow: hidden;
  box-shadow: 5px 0 15px rgba(0,0,0,.5);
}
#portada{
  background:url("10.jpg") #3F51B5;
  background-size: 100% 100%;
  border:solid .5px white;
  color: black;
  height: 15%;overflow: hidden;
}
.user_name{
  margin-left: 15px;
}
nav div{
  cursor: pointer;
}
#nav_contents{
  display: inline-block;
  margin: auto;
  width: 105%;
  height: 90%;
  padding-right: ;
  overflow-y:auto;
  overflow-x:hidden;  
}
#nav_contents div{
font-weight: bold;
padding: 10px 0 10px 5% ;
background: ;
width: 100%;
height: auto;
margin-bottom: 1%;
}
#nav_foot{
font-weight: bold;
padding: 10px 0 10px 5% ;
color:black;
width: 100%;
height: auto;  
}
#nav_foot div{
  margin-bottom: 1%;
}
#nav_contents div:hover{
  background: silver;
  color:#df0056;
}
.flexbox{
max-width: 100%;
margin: 0 auto;
}
.item img,.item canvas{
  position:relative;
  display: block;
  margin: auto;
  width: 100%;
  max-width: 100%;
  max-height: 500px;
  transition: all .5 linear;
}
.item .gif{
  width: 100%;
}
.item{
  overflow: hidden;
  background: white;
  margin-bottom: 20px;
  border-radius: 5px;
  box-shadow: 0 4px 5px rgba(0,0,0,.3);
  break-inside:avoid-column;
  overflow: hidden;
  width: 100%;
  height: auto;
}
.item:hover{
}
.item .resum{
 padding:0 20px;
 font-family: sans-serif;
color: #4048af;
 font-size: .875em;
 line-height: 1.4em;
 z-index: 10;
 }
.flexbox a,.flexbox .title{
  cursor: pointer;
  color: #df0056;
  text-decoration: none;
}
.flexbox:hover .item img,.flexbox:hover .item section,.flexbox:hover .item canvas{
  opacity: .3;
}
.flexbox .item:hover img,.flexbox .item:hover section,.flexbox .item:hover canvas{
  opacity: 1;
  }
.flexbox .item:hover .resum{
visibility: visible;
}
.flexbox .item:hover .gif:after{
background: rgba(999,999,999,.8);
color: #df0056;
}.flexbox .control{
  font-size: 20px;
  color:#4048af;
  padding-left:5px; 
}
.gif:after {
  content: 'gif';
  position: absolute;
  display: inline-block;
  width: 40px;
  text-align: center;
  top: 20px;
  right: 20px;
  font-size: 11px;
  font-weight: 600;
  padding: 5px;
  border-radius: 3px;
  color: white;
  background-color: #df0056;
  text-transform: uppercase;
}
article{
margin:10px 20px;
overflow: hidden;
background: white;
border-radius:10px;
box-shadow: 0 3px 5px rgba(50,50,50,.3);
overflow: hidden;
display: inline-block;
}
article p{
  padding: 0 10px;
  font-family: sans-serif;
  color: #6b7c93;
  line-height: 1.4em;
}
article img{
  /*display: block;
  margin: auto;
  width: 100%;
  height: 250px;*/
  max-width: 100%;
}
.logginPanel p{
  color: #df0056;
}
#publicarN,#publicarLOb{
  position: fixed;
  width: 50px;
  height: 50px;
  background: #df0056;
  border-radius: 50%;
  outline: 0;border:0;
  color: white;
  z-index: 9;
  bottom: 5%;
  right: 5%;
  font-size: 20px;
}
#publicarLOb{
position: static;
width: 30px;height: 30px;
}
#resultados{
  
}
#complete{
  width: 100%;
  display: block;
  height: auto;
  padding: 20px;
}
#complete .title{
  color: #df0056;
  padding: 0;
}
#complete .resum{
  position: static;
  padding: 20px;
  color: #4048af;
}
#complete img{
  margin-top:50px;
  display: block;
  margin: auto;
  width: 40%;
  height: 50%;
  max-width: 360px;
  min-height: 280px;
  max-height: 500px;
  position: static;
}
.flexbox .resultsBusq{
padding: 10px;
}
.flexbox .resultsBusq img{
  width: 100%;
  height: 50%;
  max-height: 300px;
}
/*areglar scrool*/
.fieldProf{
  border: solid 1px red;
  height: 400px;
  width: 100%;
  overflow:auto;
}
.field2{
  /*border: solid 1px red; 
  overflow: auto;
  height: 560px;
  width: 250px;*/
  display: flex;
  felx-direction:column;
}
.field2 img{
  border-radius: 5px;
  margin: 5px;
}
.item1 { grid-area: header;}
.item2 { grid-area: menu;}
.item3 { grid-area: main;}
.grid-container {
  display: grid;
  grid-template-areas:
    'header header '
    'menu main';
  grid-gap: 5px;
  overflow:;
}
.grid-container > div {
  max-height: 580px;
  overflow:hidden;
  text-align: center;
  padding: 5px;
}
.item1{
display: grid;
grid-gap: 10px;
}
.profileInfo1{grid-area:info;background: white;}
.profileInfo2{grid-area:publ;background: white;}
.profileInfo3{
grid-area:prev;background: url("no_image.png") white 50%;
background-repeat: no-repeat;
background-size: 50% 50%;
}
.profileInfo4{grid-area:foot;background: white;}
.profileInfo1 article{
width: auto;
margin:0;
overflow: hidden;
background: transparent;
border-radius:0;
box-shadow: none;
display: block;
}
section[class='title']{
  font-size: 25px;
}
.profileInfo1 article{
  width: 60%;
  min-height:40%;
  max-height:100%;
  text-align: left;
  padding: 20px;
  float: left;
 }
 .profileInfo1 .g1{
  font-size: 25px;
  min-height: 20%;
  font-weight: bold;
  color: #df0056;
 }
 .profileInfo1 .g2{
  width:auto;
  height: 100%;
 }
 .profileInfo1 .g2 img{
  border-radius: 20px;
  border:solid 5px white;
  box-shadow: 0 0 5px gray;
  display: block;
  margin:auto;
  margin-top:;
  width: 150px;
 }.profileInfo1 .g4{
  width: 15%;
  height: 100%;
  float:;
 }.profileInfo1 .g4 button{
background: #df0056;color: white;
border:solid 2px rgba(250,250,250,.3);
border-radius: 5px;
outline: 0;
padding: 10px;
 }
 /*Menu favo*/
 #MenuFav,#MenuEdit{
  position: fixed;
  background: rgba(250,250,250,.5);
  color: #df0056;
  z-index: 9;
  padding:20px;
  border:solid 1px;
  border-radius: 5px;
  box-shadow: 0 0 10px gray;
 }#MenuFav:hover,#MenuEdit:hover{
  background: white;
  box-shadow: 0 0 10px black;
 }#MenuFav legend,#MenuEdit legend{
  background: white;
  border:solid 1px;
 }#MenuFav section,#MenuEdit section{
  padding: 5px;
  cursor: pointer;
 }#MenuFav section:hover,#MenuEdit section:hover{
  background:#df0056;
  color: white;
  border-bottom: solid 1px #4048af;
 }
/*phone*/
@media (max-width: 480px){
    nav{
    width: 0;
  }
    #navActive:checked~nav{
  width: 50%;
  }
    .logginPanel{
    display: block;
    margin: auto;
   width: 90%;
   margin-bottom: 5%;
  }
     #body{
      margin-top: 20%;
      overflow-x: hidden;
    }
     article img{
      width: 100%;
      height: auto;
    }
     article{
    margin: 5% 0;
    width: 100%;
    height: auto;
   }
   .logginPanel article{
    min-height:360px; 
    overflow: auto;
   }
     .flexbox{
      height: auto;
     }
     .flexbox .item{
      width: 100%;

     }
     #complete img,#complete small{
      float: none;
      width: 90%;
      display: block;
      margin: auto;
     }
    .grid-container {
        grid-template-areas:
          'header'
          'main'
          'menu';
      }
    .grid-container > div {
      width: 100%;
      height: 400px;
      }
    .grid-container .item2{
            height: 340px;
            width: 100%;
            max-width: 480px;
        }
    .item2 .field2{
        width: 100%;
        min-width: 360px;
        height: 330px;
        overflow:auto;
       }
    .field2 img{
           width: 100%;
           max-width: 480px;
           min-height: 100%;
           max-height: 340px;
       }
    .item3 .otherFlex{
        height: 380px;
           overflow:auto;
       }
    .otherFlex .item{
        margin-bottom: 0px;
       }
    .grid-container .item1{
    grid-template-areas:'info''publ''prev''foot';
    height: auto;
    max-height: 1300px;
    }
    .item1 section{
        width: 95%;
        min-height: 140px;
    }.item1 .g2{
      max-height: 150px;
    }.item1 .g2 img{
    width: 75px;
    height: 50%;
    border-radius: 10px;
      }
    .item1 textarea{
        width: 90%;
        height: 150px;
    }
    
}
/*phone vertical*/
@media (min-height:100px) and (max-height: 360px){
 header{
     max-height: 50px;
 }
    #seachDiv{
        top: 55px;
    }
 article{
     height: 2em;
  width:100%;
  margin: 5% 0;
  display: block;
 }
 .flexbox{
  column-count:0;
 }
 .flexbox .item{
  width: 100%;
 }
}
/*tablet*/
@media (min-width:480px){
  header{
    padding-left: 6%;
  }
  nav{
    width: 6%;
    padding:0 10px 0 5px;
    overflow: hidden;
  }
  nav div{
    display: block;
    margin: auto;
  }
  .texts,#portada{
  display: none;
  }
  #navActive:checked~nav{
    width: 35%;
    padding: 0px;

  }
  #navActive:checked~nav .texts{
    display: inline-block;
  }
  #navActive:checked~nav #portada{
    display: block;
  }
  #body{
      margin-top: 10%;
      margin-left:7%;
    }
  article{
  margin: 5% 0;
  width: 100%;
  height: auto;
 }
  #complete img{
  float: none;
  width: 90%;
  display: block;
  margin: auto;
 }
 .flexbox{
  column-count:2;
 }
 .field2{
  padding-bottom: 100px;
  height: 100%;
  overflow-x: auto;
 }
 .field2 img{
   width: 100%;
   height: 100%;
   min-height: 380px;
   max-height: 380px;
   }
 .otherFlex{
  width: 100%;
  overflow: auto;
  max-height: 400px;
 }
 .grid-container {
    grid-template-areas:
      'header'
      'main'
      'menu';
  }
 .grid-container > div{
    max-height: 380px;
   }
 .grid-container .item1{
 grid-template-areas:
     'info info info info'
     'publ publ publ prev'
     'foot foot foot foot';
 height: auto;
 max-height: 850px;    
 }
 .item1 section{
     width: 100%;
     max-width:100%;
     height: 200px;
     max-height: 450px;
     overflow: hidden;
    }
    .item1 .profileInfo3 img{
        width: 144px;
        max-width:180px;
        max-height: 140px;
    }
 .item1 textarea{
     width: 90%;
     height: 75px;
 }

 /*.flexbox .item{
  width: 100%;
 }*/
}
/*tablet vertical*/
@media (min-width:720px){
  .logginPanel{
 width: 45%;
 display: inline-table;
  }
  nav{
    width: 5%;
  }
   #navActive:checked~nav{
    width: 25%;
    max-width: auto;
    padding: 0px;

  }
    #body{
      margin-top: 10%;
      margin-left: 7%;
    }
    article{
      width: 45%;
    }
     #complete img{
  float: left;
  width: 50%;
  display: block;
  margin: auto;
  padding: 20px;
 }
    .flexbox{
  column-count:2;
 }
 .flexbox .item img,.flexbox .item canvas{
  width: 100%;
 }
 .otherFlex{
  width: 100%;
  height: 580px;
  overflow:auto;
 }
    .grid-container > div {
  width: 100%;
  height: 100%;
  }
  .grid-container {
    grid-template-areas:
      'header header header'
      'menu main main';
  }
    .grid-container .item2{
      overflow:hidden;
    width: 240px;
    max-width: 95%;
    padding-right: ;
  }
  .field2{
  display: block;
  overflow:auto;
  overflow-x:hidden;
  width:250px;
  height: 100%;
  padding-right: 20px;
   }
    .field2 img{
   width: 100%;
   min-height: 100px;
   max-height: 350px;
  }

}
/*pc or more*/
@media (min-width:1080px){
  header{
    padding-left: 16%;
  }
  nav{
    width: 15%;
    padding: 0;
  }
  .texts{
    display: inline-block;
  }
  #portada{
    display: block;
  }
  #navActive:checked~nav{
  width: 3%;
  padding: 0;
  }
  #navActive:checked~nav div{
    width: auto;
    margin-left: 10px;
  }
  #navActive:checked~nav .texts,#navActive:checked~nav #portada{
    display: none;
  }
  #navActive:checked~#body{
        margin-left: 5%;
  }
  #navActive:checked~header{
  padding-left: 6%;
  }
    #body{
      margin-top: 6%;
      margin-left: 16%;
    }
    article{
      width: 30%;
    }
    .flexbox{
  column-count:3;
 }
 .grid-container > div{
  height: 500px;
  max-height: 550px;
 }
 .grid-container .item1{
    }
 .grid-container .item2{
    width: 300px;
    height: 500px;
    overflow: hidden;
  }.grid-container .item3{
    height: 500px;
    }.item3 .otherFlex{
      height: 550px;
      max-height: 550px;
    }
  .item2 img{
    width: 100%;
    max-height: 540px;
  }
  .item2 .field2{
    padding-right: 50px;
    width: 350px;
    overflow: auto;
    overflow-x:hidden; 
  }
    /*.flexbox .item {
    width: 30%;
   }*/
}
