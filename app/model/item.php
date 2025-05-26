<?php
require('connectionavecladb.php');

function getItemBySlug($slug)
{
    global $pdo;


    return $stmt->fetchAll();
}


function findAll()
{
    $stmt = $pdo->query('SELECT * FROM item');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}