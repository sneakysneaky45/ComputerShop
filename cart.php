<?php
session_start(); 
$product_ids = array(); 

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="cart.css">
    </head>
    <body>
        <div class = "container">
        <?php

        $connect = mysqli_connect('localhost', 'root', 'meinPasswort', 'webshop'); 
        $query = 'SELECT * FROM products ORDER by id ASC'; 
        $result = mysqli_query($connect, $query); 

        if ($result) :
            if(mysqli_num_rows($result)>0) :
                while($product = mysqli_fetch_assoc($result)) :
                    ?>
                    <div class="col-sm-4 col-md-3" >
                        <form method="post" action="addToCart.php">
                            <div class="products">
                                <img src="<?php echo $product['image']; ?>" class="img-responsive"/>
                                <h4 class="text-info"><?php echo $product['name']; ?></h4>
                                <h4>$ <?php echo $product['price']; ?></h4>
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                <input type="text" name="quantity" title="Zahl muss realistisch sein!" pattern="[0-9]{1,2}" class="form-control" value="1"/>
                                <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                                <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                                <input type="submit" name="add_to_cart" style="margin-top:5px"class="btn btn-info"
                                       value="Add to Cart" />
                            </div>
                        </form>
                    </div>
                    <?php
                endwhile;
            endif;
        endif;
        ?>
        <div style="clear:both"></div>
        <br />
        <div class="table-responsive">
        <table class="table">
                    <tr><th colspan="5"><h3>Order Details</h3></th></tr>
                    <tr> 
                        <th width="40%">Product Name</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Price</th>
                        <th width="15%">Total</th>
                        <th width="5%">Action</th>
                    </tr>
                    <?php
                        if(!empty($_SESSION['shopping_cart'])):
                            $total =0; 
                            foreach($_SESSION['shopping_cart'] as $key => $product):
                                if ($product['quantity']>0){
                    ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['quantity']; ?></td>
                        <td><?php echo $product['price']; ?>&nbsp€</td>
                        <td>$<?php echo number_format($product['quantity'] * $product['price'],2);; ?></td>
                        <td>
                            <a href="removeFromCart.php?action=delete&id=<?php echo $product['id']; ?>">
                                <div class ="btn-danger">Remove</div>
                            </a>
                        </td>
                    </tr>
                    <?php
                        $total = $total + ($product['quantity'] * $product['price']);
                                }
                        endforeach; 
                    ?>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="right">$ <?php echo number_format($total,2); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <?php
                                if(isset($_SESSION['shopping_cart'])):
                                if(count($_SESSION['shopping_cart']) > 0):
                            ?>
                                <a href="#" class="button">Checkout</a>
                            <?php endif; endif; ?>
                        </td>
                    </tr>
                    <?php
                        endif;
                    ?>
                </table>
            </div>
        </div>
    </body>                      
</html>
