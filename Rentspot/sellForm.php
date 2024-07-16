<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Selling | LeaseLab</title>
    <link rel="stylesheet" href="sell.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Sell Your Product</div>
    <div class="content">
      <form action="sell.php" method="POST" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Name</span>
            <input type="text" placeholder="Enter your name" name="user_name" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" name="email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" name="phone_number" required>
          </div>
          <div class="input-box">
            <span class="details">Product Name</span>
            <input type="text" placeholder="Enter your product name" name="product_name" required>
          </div>
          <div class="input-box">
            <span class="details">Category</span>
            <input type="text" placeholder="Ex. Musical, Sports..." name="category" required>
          </div>
          <div class="input-box">
            <span class="details">Available From </span>
            <input type="text" placeholder="Ex. 12/12/2004" name="from_date" required>
          </div>
          <div class="input-box">
            <span class="details">Available Till</span>
            <input type="text" placeholder="Ex. 12/12/2004" name="to_date" required>
          </div>
          <div class="input-box">
            <span class="details">Amount</span>
            <input type="text" placeholder="Ex. 120/Day or 150/week" name="amount" required>
          </div>
          <div class="input-box">
            <span class="details">Description</span>
            <textarea id="" cols="44" rows="3" name="description" placeholder="Enter within 250 characters"></textarea>
            <!-- <input type="text" name="description" placeholder="description" id="" required> -->
          </div>
          <div class="input-box1">
            <span class="details">Upload Image</span>
            <input type="file" name="screenshot" required>

          </div>
        </div>
        
        <div class="button">
          <button type="submit" name="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>