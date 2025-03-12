<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $method1 = $_POST['method1'];
   $method1 = filter_var($method1, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'] .' '. $_POST['street'] .' '. $_POST['city'] .' '. $_POST['state'] .' '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d-M-Y');
   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if($cart_query->rowCount() > 0){
      while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
         $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }elseif($order_query->rowCount() > 0){
      $message[] = 'order placed already!';
   }
   elseif($cart_total<100){
      $message[]='Please Buy Above 100Rs';

   }
   else{
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      $message[] = 'order placed successfully! and will be contacted using phone number provided, once items are out for delivery';
   }
   

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   

<style>
.inputBox {
  position: relative;
}
.inputBox input[id="method1"] {
  padding-left: 40px; /* Adjust this value to match the size of your logo */
  background-image: url('images/card.png'); /* Replace with the actual path to your logo */
  background-repeat: no-repeat;
  background-size: 130px; /* Adjust this value to set the logo size */
  background-position: right center; /* Adjust this value to position the logo */
}
</style>
</head>
<body>
   
<?php include 'header.php'; ?>
<h1>
   <a href="cart.php"
		class="nd">
		<img src="images/back.PNG" 
		width="60px">
	</a>
   </h1>
<section class="display-orders">


   <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if($select_cart_items->rowCount() > 0){
         while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
            
   ?>
   <p> <?= $fetch_cart_items['name']; ?> <span>(<?= 'Rs'.$fetch_cart_items['price'].'/- x '. $fetch_cart_items['quantity']; ?>)</span> </p>
   <?php
    }
   }else{
      echo '<p class="empty">your cart is empty!</p>';
   }
   if($cart_grand_total<100)
            {
               echo '<p class="empty">Please buy above 100Rs</p>';

            }
   ?>
   <div class="grand-total">grand total : <span>Rs.<?= $cart_grand_total; ?>/-</span></div>
 </div>
         
</section>

<section class="checkout-orders">
   
<form action="" method="POST" onsubmit="return validateForm();">
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" placeholder="enter your name" class="box" required>
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="tel" name="number" placeholder="provide exact phone.no used for contacting at time of delivery." class="box" required minlength="10" maxlength="10">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" placeholder="example@gmail.com" class="box" required>
         </div>
         <div class="inputBox">
            <span>address :</span>
            <input type="text" name="flat" placeholder="e.g.full adress" class="box" required>
         </div>
         <div class="inputBox">
            <span>landmark :</span>
            <input type="text" name="street" placeholder="e.g. landmark" class="box" required>
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" placeholder="e.g. Bengaluru" class="box" required>
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" placeholder="e.g. Karnataka" class="box" required>
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" placeholder="e.g. India" class="box" required>
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" class="box" required>
         </div>

         <div class="inputBox">
            <span>payment method :</span>
            <select name="method" class="box" required>
               <option value="">--Select Payment type---</option>
               <option value="debit card">debit card</option>
               <option value="credit card">credit card</option>
            </select>
            <input type="text" name="name" placeholder="enter name on Card" class="box" required>
            <input type="tel" name="method1" placeholder="enter Card Number" class="box" minlength="16" maxlength="16" required>
            <input type="tel" name="cvv" placeholder="enter CVV" class="box" minlength="3" maxlength="3" required>
         </div>
      </div>


      <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="place order">
      <div class="box-container"><a href="shop.php" class="delete-btn <?= ($cart_grand_total < 1)?'':'disabled'; ?>">home</a> 

   </form>

</section>


<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>