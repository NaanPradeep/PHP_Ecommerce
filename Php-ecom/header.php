<?php
  require('db_instantiate.php');
  if(isset($_SESSION["user_id"])) {
    $cart_items = $cart->get_cart_items($_SESSION["user_id"]);
    $no_of_cart_items = count($cart_items);
  } else {
    $no_of_cart_items = 0;
  }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Shop</title>
    <!-- Bootstrap ccdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="
    sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">    
    <!-- Owl Carousel cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="
    sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="
    sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
    
    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link type="text/css" rel="stylesheet" href="./style.css">
</head>
<body>
    <!-- Header -->
    <header id="header">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark color-secondary-bg">
            <div class="container-fluid">
              <a class="navbar-brand" href="<?php printf('index.php') ?>">Mobile Shop</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav m-auto">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">On Sale</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Category</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Products <i class="fas fa-chevron-down"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                  </li>
                </ul>
                <?php if(empty($_SESSION["user_id"])) { ?>
                  <li class="nav-item" style="list-style-type: none;">
                    <a class="nav-link text-white" href="<?php echo 'login.php' ?>">Login</i></a>
                  </li>
                  <li class="nav-item" style="list-style-type: none;">
                    <a class="nav-link text-white" href="<?php echo 'register.php' ?>">SignUp</a>
                  </li>
                <?php } else { ?>
                  <li class="nav-item" style="list-style-type: none;">
                    <a class="nav-link text-white" href="<?php echo 'logout.php' ?>">Logout</a>
                  </li>
                <?php } ?>
                <form action="#" class="font-size-12 font-raleway">
                    <a href="<?php echo 'cart.php'; ?>" class="py-2 rounded-pill color-primary-bg">
                      <span class="px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                      <span class="px-3 py-2 rounded-pill text-dark bg-light"><?php echo $no_of_cart_items ?></span>
                    </a>
                </form>
              </div>
            </div>
          </nav>
        <!-- !Navbar -->
    </header>
    <!-- !Header -->

    <!-- Main-site -->
    <main id="main-site">