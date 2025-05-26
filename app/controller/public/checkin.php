<?php

function checkin()
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        render('login.php');
    } else {
        pdo('mysql:host=localhost;dbname=sandbox;port=3306;charset=utf8mb4', 'root', 'changeme0');
        $stmt = pdo('SELECT id, password FROM operator WHERE username = ?', [$_POST['username']]);
        $operator = $stmt->fetch();
        if (!$operator || $operator['password'] !== $_POST['password']) {
            render('login.php', ['error' => 'huhuhu say the magic word']);
        } else {
            $_SESSION['active_user'] = $operator['id'];
            header('Location: /admin');
        }
    }
}

function bye()
{
    session_destroy();
    header('Location: /');
}
