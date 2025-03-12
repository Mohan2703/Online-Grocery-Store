<!DOCTYPE html>
<html>
<head>
<style>
  /* Styles for the heading and payment options */
  body{
background-color:#dfd9d9;
  }

  .p-category {
    text-align: center;
    margin-top: 20px;
    padding: 20px;

    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  }

  .p-category h1 {
    color: black;
    font-size: 24px;
    margin-bottom: 10px;
  }

  .p-category a {
    display: block;
    margin: 10px auto;
    font-size: 18px;
    color: #3498db;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .p-category a:hover {
    color: black;
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
   
<section class="p-category">
  <h1>SELECT PAYMENT OPTIONS</h1>
  <a href="checkout1.php">Cash On Delivery</a>
  <a href="checkout.php">Pay Using Debit Card/Credit Card</a>
</section>
</body>
</html>
