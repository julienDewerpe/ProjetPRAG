<?php
//=======================================================
// Deconnexion -> fermeture de la session - logout.php
//=======================================================
session_start();
session_destroy();

header("location:login.php");
?>