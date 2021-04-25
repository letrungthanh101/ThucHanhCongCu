<?php
// Redirect to the home page if id parameter not found in URL 
if (empty($_GET['id'])) {
  header("Location: index.php");
}

// Include and initialize database class 
include_once 'DB.class.php';
$db = new DB;

// Include and initialize paypal class 
include_once 'PaypalExpress.class.php';
$paypal = new PaypalExpress;

// Get product ID from URL 
$productID = $_GET['id'];

// Get product details 
$conditions = array(
  'where' => array('id' => $productID),
  'return_type' => 'single'
);
$productData = $db->getRows('products', $conditions);

// Redirect to the home page if product not found 
if (empty($productData)) {
  header("Location: index.php");
}
?>


<!doctype html>
<html lang="en">

<head>
  <title>Chi tiết sản phẩm</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#" style="text-transform: uppercase;">Hutech mobi</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Iphone
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            SamSung
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Vivo
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <div class="container">
  <h2>Sản phẩm</h2>
    <div class="row">
     
      <div class="col-md-6 ">
        <!-- Product details -->

        <img src="<?php echo $productData['image']; ?>" style="width: 500px; height: 500px;" />



        <!-- Checkout button -->

      </div>
      <div class="col-md-6">
        <h2 style="margin-top: 50px;"><?php echo $productData['name']; ?></h2>
        <h3 style="margin-top: 20px;" class="text-danger"> <?php echo $productData['price']; ?> $</h3>
        <h5 style="text-decoration: line-through;">1000$</h5>
        <div style="margin-top: 20px;">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi veniam sed impedit accusamus perferendis beatae consequatur aliquid alias provident voluptate amet repellendus quidem labore, consequuntur tempora, laudantium cum, quaerat ipsum.
          accusamus perferendis beatae consequatur aliquid alias provident voluptate amet repellendus quidem labore, consequuntur tempora, laudantium cum, quaerat ipsum.
        </div>
        <h5 style="margin-top: 20px;">Thanh toán ngay</h5>
        <div id="paypal-button" style="margin-top: 20px;"></div>

      </div>

    </div>
  </div>

  </div>
   <?php
   require_once "./footer.php"
   ?>



  <!--
JavaScript code to render PayPal checkout button and execute payment
-->
  <script>
    paypal.Button.render({
      // Configure environment
      env: '<?php echo $paypal->paypalEnv; ?>',
      client: {
        sandbox: '<?php echo $paypal->paypalClientID; ?>',
        production: '<?php echo $paypal->paypalClientID; ?>'
      },
      // Customize button (optional)
      locale: 'en_US',
      style: {
        size: 'small',
        color: 'gold',
        shape: 'pill',
      },
      // Set up a payment
      payment: function(data, actions) {
        return actions.payment.create({
          transactions: [{
            amount: {
              total: '<?php echo $productData['price']; ?>',
              currency: '<?php echo $productData['currency']; ?>'
            }
          }]
        });
      },
      // Execute the payment
      onAuthorize: function(data, actions) {
        return actions.payment.execute()
          .then(function() {
            // Show a confirmation message to the buyer
            //window.alert('Thank you for your purchase!');

            // Redirect to the payment process page
            window.location = "process.php?paymentID=" + data.paymentID + "&token=" + data.paymentToken + "&payerID=" + data.payerID + "&pid=<?php echo $productData['id']; ?>";
          });
      }
    }, '#paypal-button');
  </script>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>