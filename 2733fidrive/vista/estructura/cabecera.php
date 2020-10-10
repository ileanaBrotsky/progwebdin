<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS PROPIO -->
  <link rel="stylesheet" href="../css/csspropio.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- para contraseña con medidor de seguridad -->
  <link rel="stylesheet" href="../css/style.css">
  
  <!-- animaciones -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  
  <!-- para contraseña con medidor de seguridad -->
  <link rel="stylesheet" href="https://www.jqueryscript.net/css/jquerysctipttop.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,600&display=swap" >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/minty/bootstrap.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>
  <link rel="stylesheet" href="../css/style.css">
  
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
    <p class="navbar-brand col-md-3 col-lg-2 ml-3 pl-5 text-align-left">Program. Web Dinámica</p>
    <!-- boton que se muestra cuando se achica la pantalla y desaparece el menú lateral lo identifica por el id-->
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <!-- contenedor general de todo el ancho de la página -->
  <div class="container-fluid ">
    <!-- fila 1 -->
    <div class="row">
      <!-- contenedor del menú al costado de la página -->
      <nav id="sidebarMenu" class="col-md-2 d-md-block  shadow  rounded sidebar collapse mb-3">
        <!-- contenedor fijo que ordena los titulos del sidebar -->
        <div class="sidebar-sticky pt-3">
          <!-- icono y link de vuelta al home -->
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-5 text-muted">
            <a class=" nav-link text-decoration-none font-bold text-dark shadow" href="../scripts/interface.php">
              <svg width="24" height="24" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
              </svg> Inicio</h6></a>
          <!-- titulo de trabajos -->
          <h4 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <strong>Entrega 9/10/2020</strong></h4>
          <ul class="nav flex-column  mb-2">
            <li class="nav-item mt-3 mb-3">
              <a class="nav-link" href="../scripts/contenido.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                CONTENIDOS
              </a>
            </li>
            <li class="nav-item mt-3 mb-3">
              <a class="nav-link" href="../scripts/compartidos.php">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-share-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/>
                  </svg>
                ARCHIVOS COMPARTIDOS
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <main role="main" class=" col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">

          <?php
          include_once("../../configuracion.php");

          ?>