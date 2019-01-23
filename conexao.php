<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=devtube_loginphp", "developer", "dev123");
    $conn->exec("SET NAMES utf8");
} catch(PDOException $e) {
    echo $e->getMessage();
    exit;
}
