<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="<?php bloginfo( 'charset' ) ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php wp_title( ' - ', 1, 'right' ); bloginfo( 'name' ); ?></title>
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <?php wp_head(); ?>
        <?php include_once(dirname(__FILE__) . '/analyticstracking.php'); ?>
        <?php $pagetitle = strtolower(get_the_title()); ?>
    </head>
    <body <?php body_class($pagetitle); ?>>
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
