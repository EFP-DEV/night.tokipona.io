<?php
require('connectionavecladb.php');

function findAll(){
    $stmt = $pdo->query('SELECT * FROM tag');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}