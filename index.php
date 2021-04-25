<?php
// Include and initialize database class 
include_once 'DB.class.php';
$db = new DB;

// Get all products from database 
$products = $db->getRows('products');
?>



<!doctype html>
<html lang="en">

<head>
    <title>Hutech Mobi</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>

<body>
    <div class="container-fluid">
        <!-- List products -->
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
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="https://img3.thuthuatphanmem.vn/uploads/2019/10/08/banner-quang-cao-dien-thoai-dep_103211368.jpg" alt="First slide" style="width: 500px; height: 400px;">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://img3.thuthuatphanmem.vn/uploads/2019/10/08/banner-quang-cao-dien-thoai_103211774.jpg" alt="Second slide" style="width: 500px; height: 400px;">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://bachlongmobile.com/media/bannernext/b/l/bl-1200x450-banner-samsung-sieu-sale1-min.png" alt="Third slide" style="width: 500px; height: 400px;">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container">
            <h4>Sản phẩm nổi bật</h4>
            <div class="row ">
                <?php
                if (!empty($products)) {
                    foreach ($products as $row) {
                ?>
                        <div class="item col-md-3">
                            <div class="card">
                                <img class="card-img-top" src="<?php echo $row['image']; ?>" style="height: 200px; width: 220px;" />
                                <div class="card-body">
                                    <h4 class="card-title "><?php echo $row['name']; ?></h4>
                                    <h5 class=" text-danger bold"> <?php echo $row['price']; ?> $</h5>
                                    <p style=" text-decoration: line-through; ">300$</p>
                                    <p class="card-text">This is a wider card with supporting text below as </p>                           
                                    <a class="btn btn-danger" href="checkout.php?id=<?php echo $row['id']; ?>">BUY NOW</a>
                                    <p class="card-text "><small class="text-muted">Last updated 1 mins ago</small></p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<p>Product(s) not found...</p>';
                }
                ?>


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