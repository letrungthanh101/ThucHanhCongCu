<?php
if (!empty($_GET['id'])) {
    // Include and initialize database class 
    include_once 'DB.class.php';
    $db = new DB;

    // Get payment details 
    $conditions = array(
        'where' => array('id' => $_GET['id']),
        'return_type' => 'single'
    );
    $paymentData = $db->getRows('payments', $conditions);

    // Get product details 
    $conditions = array(
        'where' => array('id' => $paymentData['product_id']),
        'return_type' => 'single'
    );
    $productData = $db->getRows('products', $conditions);
} else {
    header("Location: index.php");
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>Thanh toán</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="status">
            <?php if (!empty($paymentData)) { ?>
                <h1 class="success text-success text-center">Your Payment has been Successful!</h1>
                <h4>Thông tin thanh toán</h4>
                <p><b>TXN ID:</b> <?php echo $paymentData['txn_id']; ?></p>
                <p><b>Tổng tiền:</b> <?php echo $paymentData['payment_gross'] . ' ' . $paymentData['currency_code']; ?></p>
                <p><b>Trạng thái thanh toán:</b> <?php echo $paymentData['payment_status']; ?></p>
                <p><b>Ngày thanh toán:</b> <?php echo $paymentData['created']; ?></p>
                <p><b>Tài khoản thanh toán:</b> <?php echo $paymentData['payer_name']; ?></p>
                <p><b>Email:</b> <?php echo $paymentData['payer_email']; ?></p>

                <h4>Thông tin sản phẩm</h4>
                <p><b>Tên sản phẩm:</b> <?php echo $productData['name']; ?></p>
                <p><b>Giá:</b> <?php echo $productData['price'] . ' ' . $productData['currency']; ?></p>
            <?php } else { ?>
                <h1 class="error">Thanh toán thất bại</h1>
            <?php } ?>
            <a class="btn btn-danger" href="index.php">Tiếp tục mua sắm</a>
        </div>
    </div>
    <?php
    require_once "./footer.php"
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>