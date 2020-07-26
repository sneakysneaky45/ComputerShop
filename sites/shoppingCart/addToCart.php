<?php
    header("Location: cart.php"); 
    session_start(); 

    $product_ids = array(); 
    if(isset($_SESSION['shopping_cart'])) {
        $count = count($_SESSION['shopping_cart']); //zähler, wie viele Produkte drinnen sind
        
        $product_ids = array_column($_SESSION['shopping_cart'], 'id'); //array, das array keys mit product ids zusammenfügt
        
        if(!in_array(filter_input(INPUT_POST,'id'), $product_ids)) { //prüft, ob produkt mit dieser id schon exisitert
        $_SESSION['shopping_cart'][$count] = array
            (
                'id' => filter_input(INPUT_POST, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );
        } else { //es existiert schon in shopping cart
            for ($i = 0; $i < count($product_ids); $i++) { // richtiges Produkt finden
                if($product_ids[$i] == filter_input(INPUT_POST, 'id')) {
                    // im array anzahl von bestehendem produkt aktualisieren
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity'); 
                }
            }
        }
        
    } else { //wenn shopping cart nicht existierte, erstes produtk mit arraykey 0 erstellen
        // array erstellen, daten aus formular
        $_SESSION['shopping_cart'][0] = array
            (
                'id' => filter_input(INPUT_POST, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
?>
