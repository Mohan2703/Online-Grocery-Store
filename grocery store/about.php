<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/about-img-1.png" alt="">
         <h3>why choose us ?</h3>
         <p>There are a number of reasons to do business with Consumer Fresh Produce. We provide the freshest, highest quality Grocery Items for your daily needs.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

      <div class="box">
         <img src="images/about-img-2.png" alt="">
         <h3>what we provide .</h3>
         <p>Raghavendra Stores is another form of retailing, primarily focusing on selling Fruits, Vegetables, Snacks and other daily essentials to the consumers.</p>
         <a href="shop.php" class="btn">our shop</a>
      </div>

      <div class="box">
         <img src="images/about-img-3.png" alt="">
         <h3>free delivery !</h3>
         <p>We provide free home delivery. we cover the cost of shipping your order to you, so you won't have to pay any additional fees for shipping.</p>
         <a href="cart.php" class="btn">my cart</a>
      </div>

   </div>

</section>

<script src="js/script.js"></script>

</body>
</html>