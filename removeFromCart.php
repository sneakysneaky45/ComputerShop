<?php
    header("Location: cart.php"); 
    session_start(); 

    $product_ids = array(); 
    if(isset($_SESSION['shopping_cart'])) {
        $count = count($_SESSION['shopping_cart']); //zähler, wie viele Produkte drinnen sind
        echo $count; 
        $id = filter_input(INPUT_GET, 'id')-1; 
        if ($_SESSION['shopping_cart'][$id]['quantity'] > 0) {
        $_SESSION['shopping_cart'][$id]['quantity']--;        
        }
 
    }
?>