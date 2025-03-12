<!DOCTYPE html>
<html>
<head>
<style>
  /* Styles for the heading and payment options */
  
  body {
    background-image: url('images/payment_bg1.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }

  .p-category {
    /* text-align: center;
    margin-top: 65px;
    padding: 62.5px;
    background-color: black;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); */
    text-align: center;
     margin-top: 65px;
     padding: 62.5px;
     background-color: rgba(0, 0, 0, 0.5); /* Adjust the alpha value to change the transparency */
     border-radius: 5px;
     box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
     backdrop-filter: blur(10px); /* Adjust the blur radius as needed */
  }

  .p-category h1 {
    color: white;
    font-size: 4rem;
    margin-bottom: 30px;
    text-decoration: underline;
  }

  .p-category a {
    display: block;
    margin: 10px auto;
    font-size: 60px;
    color: cyan;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .p-category a:hover {
    text-decoration: underline;
    color: greenyellow
  }

  /* Styles for the content */
  .content {
    margin-top: 30px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  }

  .content h2 {
    color: black;
    font-size: 24px;
    margin-bottom: 10px;
  }

  .content p {
    font-size: 18px;
    line-height: 1.5;
    color: black;
  }
</style>
</head>
<body>
<a href="cart.php"
		class="nd">
		<img src="images/back.PNG" 
		width="60px">
	</a>
<section class="p-category">
  <h1>SELECT PAYMENT OPTION</h1>
  <a href="checkout.php">• Pay Using Debit Card/Credit Card</a>
  <a href="checkout1.php">• Cash/Upi On Delivery</a>
</section>
</body>
</html>
