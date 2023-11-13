<?php

    session_start();

    if( !$_SESSION["email"] ){
        header("Location: ./login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sistema de Controle Financeiro</title>
    
    <link href="./resorce/css/style.css" rel="stylesheet">

    <style> 
     .hidden {
         display: none;
     }
    </style>

</head>

<body>

    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>


     






    <div id="main-wrapper">

        <div class="nav-header">

             <div class="brand-logo">

                <a >
                    <span class="brand-title">
                    <i class="fa fa-usd menu-icon text-white"> </i><span class="text-white "> Gerenciador</span>
  
                    </span>
                </a>
            </div> 
        </div>

        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
               <div class="text-center">
                <h2 class="pt-3"> Sistema de Controle Financeiro </h2>
                 </div>
                
            </div>
        </div>

        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                   <br> <br>       
                    <li>
                        <a href="./index.php"  >
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Painel</span>
                        </a>
                    </li>


                    <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Despesas</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./add-expense.php">Add despesa</a></li>
                            <li><a href="./manage-expense.php">Controle de despesa</a></li>

                        </ul>
                    </li>

                    <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Relatorio de despesa</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./daywise-report.php">Despesas diarias</a></li>
                            <li><a href="./weekwise-report.php">Despesas semanais</a></li>
                            <li><a href="./monthwise-report.php">Despesas mensais</a></li>


                        </ul>
                    </li>

                    <li>
                        <a href="include/logout.php" >
                            <i class="icon-logout menu-icon"></i><span class="nav-text">Sair da conta</span>
                        </a>
                    </li>
                    <li>
                        <a href="./profile.php"  >
                            <img src="https://icon-library.net//images/icon-profile/icon-profile-20.jpg" width="14">
                            <i class="icon-meter menu-icon"></i><span class="nav-text">Perfil</span>
                        </a>
                    </li>                 
                </ul>
            </div>
        </div>
        <div class="content-body">



        <div class="modal fade" id="showModal" data-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="modalHead" class="modal-header">
                    <button id="modal_cross_btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span  aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p id="addMsg"></p>
                </div>
                <div class="modal-footer ">
                    <div class="mx-auto">
                        <a type="button" id="changeHrefForAdding" href="#" class="btn btn-primary" >Add despesa do dia</a>
                        <a type="button" id="changeHrefToShowReport" href="#" data-dismiss="modal" class="btn btn-primary">Fechar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
            


            <div class="container-fluid">

            