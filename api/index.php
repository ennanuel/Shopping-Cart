<?php

require_once "../autoload.php";

if(isset($_GET['get'])) {

    $prod = new ProductController();

    $products = $prod->fetchProduct();

    $prod->echoJson($products);
    
}