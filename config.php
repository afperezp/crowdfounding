<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'crowdfounding');
 
/* Attempt to connect to MySQL database */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
#if($connection === false){
#    die("ERROR: Could not connect. " . mysqli_connect_error());
#    echo "Conexion no fue establecida.";
#}
#else{
#    echo "Conexion con la base de datos fue establecida exitosamente";

?>