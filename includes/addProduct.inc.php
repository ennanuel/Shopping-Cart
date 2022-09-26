<?php

require_once "../autoload.php";

if(isset($_POST['add'])) {

    $products = new ProductController();

    $name = $_POST['add-name'];
    $quantity = $_POST['add-quantity'];
    $price = $_POST['add-price'];
    $file = $_FILES['addImage'];

    $image = $products->addImage($file);

    if($products->insertProduct($name, $price, $quantity, $image)) {
        header('location: ../index.php?msg=added');
    }

}