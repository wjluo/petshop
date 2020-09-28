<?php

require_once('config.php');
require_once('functions.php');

?>

<!DOCTYPE html>
<html lang="gr">

<head>

    <title>Petshop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Fontawesome css -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo ROOT_URI ?>style/main.css">
    <link rel="stylesheet" href="<?php echo ROOT_URI ?>style/login.css">
    <link rel="stylesheet" href="<?php echo ROOT_URI ?>style/register.css">

    <!-- Important Owl css -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

</head>

<?php include('headbar.php'); ?>