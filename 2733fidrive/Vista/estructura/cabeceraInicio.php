<?php
include_once("../../Control/Session.php");
$session= new Session;
$session->cerrarSession();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- -----------Required meta tags----------- -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- --------------CSS---------------------- -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrapMinty.min.css">
  <link rel="stylesheet" href="../css/style.css">
  
  <!-- -----------animaciones----------------- -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  
  
   
  <!--link de iconos fontawson-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/efd76e4739.js" crossorigin="anonymous"></script>
  <!--link de iconos fontastic-->
  <link href="https://file.myfontastic.com/5pjGU5njX24UjvLk5pkcgL/icons.css" rel="stylesheet">
  <!--letras-->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
 
 
  </head>

<!-- imagen del fondo -->
<body background="../imagenes/fondo.jpg">

  <!-- navegador-cabecera de arriba tipo fijo  -->
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <p class="navbar-brand col-md-3 col-lg-2 ml-3 pl-5 text-align-left">Program. Web Dinámica - proyecto fidrive- Entrega 5</p>
    
  </nav>
  <!-- contenedor general de todo el ancho de la página -->
  <div class="container-fluid ">
   
      
      

          <?php
          include_once("../../configuracion.php");
          date_default_timezone_set("America/Argentina/Buenos_Aires");

          ?>