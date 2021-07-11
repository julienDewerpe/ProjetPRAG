<?php
//==============================================================
// Connexion à notre base de données mySQL locale - phpmyadmin
//==============================================================

$connect = new PDO('mysql:host=localhost;dbname=prag', 'root', '');
session_start();

?>