<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=db_scv", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro no banco: ' . $e->getMessage();
}

/**<?php
include('config.php');
try {
  $conn = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $user, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?> */
