<?php

    require_once "./autoload.php";

    $prod = new ProductController();
    $products = $prod->fetchProduct();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Add or Edit Product</title>
</head>
<body>
    
    <section class="product-form">
        <div class="settings-switch" id="form-switch">
            <button class="switch" id="add-prod-switch">ADD PRODUCT</button>
            <button class="switch" id="edit-prod-switch">EDIT PRODUCT</button>
        </div>

        <?php
    
        if(isset($_GET['msg'])) {
            $msg = "";
            $color = "";
            switch($_GET['msg']) {
                case "added":
                    $msg = "Product Added.";
                    $color = "green";
                    break;
                case "edited":
                    $msg = "Product Edited.";
                    $color = "orange";
                    break;
                case "deleted":
                    $msg = "Product Deleted.";
                    $color = "red";
                    break;
            }
            echo "<h1 id='msg' style='color:" .$color ."; text-align: center;'>" .$msg ."</h1>";
        }
    
        ?>
        
        <div id="edit-product" class="container">
            <div class="form-top">
                <h2 class="form-title" id="edit-title">Edit Product</h2>
                <div class="prod-image">
                        <img src="./images/empty.png" alt="Product Image" id="edit-img" class="prod-img">
                </div>
            </div>

            <form action="./includes/editProduct.inc.php" method="post" class="edit-product form" enctype="multipart/form-data">
                <label for="select-product">Select Product</label>
                <select name="id" id="select-product" class="form-input">
                    <option value="">-- Select Option --</option>
                    <?php 

                        if(!empty($products)) {
                            foreach($products as $product) {
                                echo "<option id='"
                                .$product['id'] ."' value='" 
                                .$product['id'] ."' data-title='"
                                .$product['title'] ."' data-price='"
                                .$product['price'] ."' data-quantity='"
                                .$product['quantity'] ."' data-img='"
                                .$product['image_name'] ."'>"
                                .$product['title'] 
                                ."</option>";
                            }
                        }

                    ?>
                </select>
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-input" value="">
                <label for="price">Price(#)</label>
                <input type="number" name="price" id="price" class="form-input">
                <label for="quantity">Quantity Available</label>
                <input type="number" name="quantity" class="form-input" id="quantity">
                <label for="image">Product Image</label>
                <input type="file" name="image" id="image" class="file-input" accept="image/jpeg, image/png">
                <input type="hidden" id="hidden-input" name="former-img">
                <div class="buttons">
                    <input class="form-btn" id="edit-btn" name="edit" type="submit" value="DONE">
                    <Input class="form-btn" id="delete-btn" name="delete" type="submit" value="DELETE">
                </div>
            </form>

        </div>

        <div id="add-product" class="container">
            <div class="form-top">
                <h2 class="form-title">Add Product</h2>
                <div class="prod-image">
                        <img src="./images/empty.png" alt="Product Image" class="prod-img" id="add-img">
                </div>
            </div>
            <form action="./includes/addProduct.inc.php" method="post" class="add-product form" enctype="multipart/form-data">
                <label for="add-name" class="add-input">Product Name</label>
                <input type="text" name="add-name" id="add-name" class="form-input add-input">
                <label for="add-price" class="add-input">Price(#)</label>
                <input type="number" name="add-price" id="add-price" class="form-input add-input">
                <label for="add-quantity" class="add-input">Quantity Available</label>
                <input type="number" name="add-quantity" class="form-input add-input" id="add-quantity">
                <label for="add-image" class="add-input">Product Image</label>
                <input type="file" name="addImage" id="addImage" class="file-input add-input" accept="image/png, image/jpeg">
                <input class="form-btn" id="add-btn" name="add" type="submit" value="ADD">
            </form>
        </div>
        
    </section>

    <script src="./script.js"></script>

</body>
</html>