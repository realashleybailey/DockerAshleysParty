<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo !$title ? SITE_NAME : SITE_NAME . ' - ' . $title; ?>
    </title>

    <link rel="icon" href="/assets/img/favicons/favicon.ico">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./css/main.css">
    <link href="./css/index.css" rel="stylesheet">
</head>

<body>
    <style>
        .nav_bar {
            padding: 20px;
            padding-bottom: 0px;
        }

        .nav_bar .navbar {
            border-radius: 5px;
            padding-left: 10px;
        }
    </style>
    <!-- Nav Bar -->
    <div class="nav_bar">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark min-width-home">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><?php echo SITE_NAME ?></a>
                <button class="navbar-toggler collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="navbar-collapse collapse" id="navbarNav" style="">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="Logout()">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- Nav Bar End -->