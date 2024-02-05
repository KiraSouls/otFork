<?php
include '../conn/connn.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/materialize.min.css">
  <script src="https://kit.fontawesome.com/84ab74bffd.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.css">
  <link rel="stylesheet" href="../css/web-app.css">
  <link rel="stylesheet" href="../css/notifications.css">
    <style media="screen">
        header, main, footer {
            padding-left: 300px;
        }

        .navnav{
          display: none;
        }
        @media only screen and (max-width : 992px) {
            header, main, footer {
                padding-left: 0;
            }
            .navnav{
              display: inherit;
            }
        }
    </style>
    <title>SCINFORMATICA</title>
</head>
<body>
  <main>

    <?php include 'menu_tech.php' ?>
