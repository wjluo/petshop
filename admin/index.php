<?php
require_once('../config.php');
require_once('../server.php');

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: turnover.php");
} else {
    header("Location: ../index.php");
}
