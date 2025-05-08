<?php 
requireRole('user');

view('user/dashboard.php',  [
    'user' => $_SESSION['user'],
]);