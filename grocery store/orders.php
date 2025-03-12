<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* styles here */
        .print-btn {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s, color 0.3s;
        }

        .print-btn:hover {
            background-color: red;
            
        }
    </style>
    <script>
        function printOrder(orderId) {
            var orderBox = document.getElementById("order_" + orderId).cloneNode(true);
            var printWindow = window.open('', '', 'width=800,height=600');
            printWindow.document.write('<html><head><title>Print Order</title></head><body>');
            printWindow.document.write(orderBox.innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</head>

<body>
    <?php include 'header.php'; ?>

    <section class="placed-orders">
        <h1 class="title">Placed Orders</h1>
        <div class="box-container">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_orders->execute([$user_id]);
            if ($select_orders->rowCount() > 0) {
                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box" id="order_<?= $fetch_orders['id']; ?>">
                        <p class="head"><h2><center>SRI RAGHAVENDRA STORES </center></h2></p>
                        <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
                        <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
                        <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
                        <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
                        <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
                        <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
                        <p> your orders : <span><?= $fetch_orders['total_products']; ?></span> </p>
                        <p> total price : <span>Rs<?= $fetch_orders['total_price']; ?>/-</span> </p>
                        <p> payment status : <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') { echo 'red'; } else { echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
                        <button class="print-btn" onclick="printOrder(<?= $fetch_orders['id']; ?>)">Print</button>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No orders placed yet!</p>';
            }
            ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>
