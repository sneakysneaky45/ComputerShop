<?php
session_start(); 
$product_ids = array(); 

?>

<!DOCTYPE html>
<html>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Product example · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/product/">

    <!-- Bootstrap core CSS -->
      <link href="../../assets/dist/css/bootstrap.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
	        <title>Shopping Cart</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="cart.css">

	</head>
	<body>
    <nav class="site-header sticky-top py-1">
		<div class="container d-flex flex-column flex-md-row justify-content-between">
			<a class="py-2 d-none d-md-inline-block" href="../mainPage/index.php">Heim</a>
			<a class="py-2 d-none d-md-inline-block" href="#">Menü</a>
			<a class="py-2 d-none d-md-inline-block" href="../meinBereich/meinBereich.php">Mein Bereich</a>
			<a class="py-2 d-none d-md-inline-block" href="../shoppingCart/cart.php">Einkaufswagen</a>
			<a class="py-2 d-none d-md-inline-block" href="../login/login.php">Login</a>
		</div>
	</nav>
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
                        <form method="post" action="../utilities/addToCart.php">
                            <div class="products">
                                <img src="<?php echo $product['image']; ?>" class="img-responsive"/> //nicht funktionsfähig da entfernt wird
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
                            <a href="../utilities/removeFromCart.php?action=delete&id=<?php echo $product['id']; ?>">
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
                                <a href="../checkoutPage/checkoutPage.php" class="button">Checkout</a>
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
<footer class="container py-5">
  <div class="row">
    <div class="col-12 col-md">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mb-2" role="img" viewBox="0 0 24 24" focusable="false"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
      <small class="d-block mb-3 text-muted">&copy; 2020</small>
    </div>
    <div class="col-6 col-md">
      <h5><a class="linkBottom" href="../footer/datenschutz.php">Datenschutz</a></h5>
    </div>
    <div class="col-6 col-md">
      <h5><a class="linkBottom" href="../footer/subaroimprezzo.php">Impressum</a></h5>
    </div>
    <div class="col-6 col-md">
      <h5><a class="linkBottom" href="../footer/ueberuns.php">&Uumlber uns</a></h5>
    </div>
    <div class="col-6 col-md">
      <h5><a class="linkBottom" href="../footer/agbs.php">AGBs</a></h5>
    </div>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script></body>
</html>	
