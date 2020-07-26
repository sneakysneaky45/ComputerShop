<?php
session_start();
?>
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
	    <!-- Custom styles for this template -->
    <link href="productPage.css" rel="stylesheet">
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
 <?php
	include'../utilities/db_connection.php';
	$con = openCon();
	$productID = $_GET['productID'];
	$query = "SELECT * FROM products WHERE ID = '$productID'";
	$result = mysqli_query($con,$query);
	if ($result) {
        if(mysqli_num_rows($result)>0){
			$product = mysqli_fetch_assoc($result);
		}
		}
	?>
  <!-- Page Content -->
  <div class="container">
      <div class="col-lg-9">

        <div class="card mt-4">
          <img class="card-img-top img-fluid" src="../../images/<?php echo $product['image']; ?>">
          <div class="card-body">
            <h3 class="card-title"><?php echo $product['name']; ?></h3>
            <h4><?php echo $product['price']; ?>€</h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente dicta fugit fugiat hic aliquam itaque facere, soluta. Totam id dolores, sint aperiam sequi pariatur praesentium animi perspiciatis molestias iure, ducimus!</p>
			<form method="post" action="../utilities/addToCart.php">
			<input type="hidden" name="action" value="add">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <input type="text" name="quantity" pattern="[0-9]{1,2}" class="form-control" value="1"/>
            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
			<input type="submit" name="add_to_cart" style="margin-top:5px"class="btn btn-success"
            value="Add to Cart" />
			</form>
			<span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            4.0 stars
          </div>
        </div>
        <!-- /.card -->

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Product Reviews
          </div>
          <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <small class="text-muted">Posted by Anonymous on 3/1/17</small>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <small class="text-muted">Posted by Anonymous on 3/1/17</small>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <small class="text-muted">Posted by Anonymous on 3/1/17</small>
            <hr>
            <a href="#" class="btn btn-success">Leave a Review</a>
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->

    </div>

  </div>
  <!-- /.container -->

  



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
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script></body>
</html>