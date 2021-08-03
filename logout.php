<?php
session_start();
session_destroy();

unset( $_SESSION["loggedin"]);
unset($_SESSION['sess_user']);

unset( $_SESSION["login"]);
unset($_SESSION['sess_user_cust']);


header('Location: index.php');

?>