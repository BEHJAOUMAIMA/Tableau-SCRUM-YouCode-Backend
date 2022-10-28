<?php
    $serverName = "Localhost";
    $userName = "YouCode";
    $password = "";
    $dataBase ="youcodescrumboard";
    //CONNECT TO MYSQL DATABASE USING MYSQLI
    $connexion = mysqli_connect($serverName,$userName,$password,$dataBase);
    // Check connection
    if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
    }
