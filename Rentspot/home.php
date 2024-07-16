<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="home.css">
    <title>RENTSPOT</title>
</head>

<body>
   <div class="nav">
   <div class="logo">
      <h2>RENTSPOT</h2>
  </div>
  <div class="user">
            <h3 style="color: #fff;">Account: <?php echo $_SESSION['email']; ?> </h3>
        </div>
  </div>
<div class="cards">
         <h2 class="header">
            Welcome to RentSpot!
         </h2>
         <div class="services">
            <div class="content content-1">
               <div class="fas fa-cart-arrow-down"></div>
               <h2>
                  Get a product For Rent
               </h2>
               <p>
                  Click below and get a product for rent.
               </p>
               <a href="products.php">Take For Rent</a>
            </div>
            
            <div class="content content-2">
               <div class="fas fa-handshake"></div>
               <h2>
                  Give product For Rent
               </h2>
               <p>
               Click below and provide a product for rent.
               </p>
               <a href="sellForm.php">Prodvide For Rent</a><!--sellForm.php  -->
            </div>

            <div class="content content-3">
               <div class="far fa-credit-card"></div>
               <h2>
                  Previous Transactions
               </h2>
               <p>
                  Wanna look back to previous transactions?
               </p>
               <a href="myproducts.php">View</a><!--myproducts.php  -->
            </div>
         </div>
      </div>

</body>

</html>