<?php
ob_start();
session_start();
require "baglan.php";
$message="";

if(isset($_POST["login"])){
  if(empty($_POST["username"]) && empty($_POST["password"])){
    $message = '<p>Tüm Alanlar Zorunludur</p>';
  } 
  else{
    $sorgu = "SELECT * FROM login WHERE username =:username AND password =:password ";
    $baglanti = $conn->prepare($sorgu);
    $baglanti->execute(
      array(
        'username' => $_POST["username"],
        'password' => md5($_POST["password"])
      )
      );
      $count = $baglanti->rowCount();
      if($count >0){
        $_SESSION["username"] = $_POST["username"];
        header("location:/assets/panel/index.php");
      }
      else{
        echo "$message";
      }
    }}


?>
<!doctype html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CHAPO & ANDREW</title>
    <link rel="icon" href="../images/icon.png" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/d8bff56e02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="stylee.css">
    <script src="stylee.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</head>
<style>
   html {
    background: rgb(0,0,0);
    background: linear-gradient(108deg, rgba(0,0,0,1) 19%, rgba(0,97,156,1) 52%, rgba(0,0,0,1) 84%);
   }

</style>
<body>

<div id="logo"> 
  <h1><i> CHAPO & ANDREW</i></h1>
</div> 
<section class="stark-login">

  <form action="" method="post">	
    <div id="fade-box">
      <input type="text" name="username" id="username" placeholder="Kullanıcı adı" required>
        <input type="password" name="password" placeholder="Şifre" required>

          <button type="submit" name="login">Giriş Yap</button> 
        </div>
      </form>
      <div class="hexagons">
        
              </div>      
            </section> 

            <div id="circle1">
              <div id="inner-cirlce1">
                <h2> </h2>
              </div>
            </div>

            <ul>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
            </ul>

  <script src='https://codepen.io/assets/libs/fullpage/jquery.js'></script>

  <script src="js/index.js"></script>

</body>

</html>