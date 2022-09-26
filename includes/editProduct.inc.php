<?php

require_once "../autoload.php";

$products = new ProductController();

if(isset($_POST['edit'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image = null;

    if(!empty($_FILES['image']['name'])) {

        $file = $_FILES['image'];

        $formerFile = '../images/products/' .$_POST['former-img'];
    
        unlink($formerFile);
    
        $image = $products->addImage($file);

    }

    if($products->editProduct($id, $name, $price, $quantity, $image)) {   
        header('location: ../index.php?msg=edited');
    }

}


if(isset($_POST['delete'])) {
    $products->deleteProduct($_POST['id']);

    $formerFile = '../images/products/' .$_POST['former-img'];
        
    unlink($formerFile);

    header('location: ../index.php?msg=deleted');
}