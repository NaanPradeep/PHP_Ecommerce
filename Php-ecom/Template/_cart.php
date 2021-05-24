<?php 
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["delete-cart-item"])) {
            print_r("Outer");
            $cart->delete_cart_item($_POST["cart_id"]);
        }
        
        if(isset($_POST["quant-up-button"])) {
            $cart->change_quantity($_POST["quant-up"], "Increase");
        }

        if(isset($_POST["quant-down-button"])) {
            $cart->change_quantity($_POST["quant-down"], "Decrease");
        }

        if(isset($_POST["new-phone-submit"])) {
            $user_data = $auth->check_login();
            if(isset($user_data)) {
                $user_id = $user_data["user_id"];
                $item_id = $_POST["item_id"];
                $cart->add_to_cart($user_id, $item_id);
            }
        }

        if(isset($_POST["proceed-to-buy"])) {
            if(isset($cart_items) && isset($_POST["total-price"])) {
                $products_array = array();
                $index = 0;
                foreach($cart_items as $cart_item) {
                    $result = $product->get_data_by_id($cart_item["product_id"]);
                    $result["quantity"] = $cart_item["quantity"];
                    $result["order_price"] = $cart_item["quantity"] * $result["item_price"];
                    $products_array[$index] = $result;
                    $index += 1;
                }
                $_SESSION["checkout_products"] = $products_array;
                $_SESSION["total_price"] = $_POST["total-price"];
                if(isset($_SESSION["checkout_products"]) && isset($_SESSION["total_price"])) {
                    header("Location: ship_address.php");
                }
            }
        }
    }

    $total_price = 0;
?>

<!-- Shopping cart section  -->
<section id="cart" class="py-3">
            <div class="container">
                <h4 class="font-rubik font-size-20 pt-5">Shopping Cart</h4>
                <hr class="hr">
                <div class="container">
                    <div class="cart-section">
                        <div class="item-section">
                    <?php foreach($cart_items as $item) { ?>
                    <?php $product_data = $product->get_data_by_id($item["product_id"]);?>
                    <?php $total_price += $product_data["item_price"] * $item["quantity"] ?>
                    
                            <div class="cart-row">
                                <div class=".cart-column-img">
                                    <img style="width: 200px" src="<?php echo $product_data["item_image"]; ?>" alt="cart-product">
                                </div>
                                <div class="cart-column-details pt-3">
                                    <h6><?php echo $product_data["item_name"]; ?></h6>
                                    <p>by <?php echo $product_data["item_brand"]; ?></p>
                                    <div class="d-flex rating flex-column">
                                        <div class="text-warning font-size-16">
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="far fa-star"></i></span>
                                        </div>
                                        <a href="#" class="font-size-16 font-raleway text-decoration-none">20,534 ratings | 1000+ answered questions</a>
                                    </div>
                                    <div class="d-flex quantity">
                                        <form method="post">
                                            <input type="hidden" name="quant-up" value="<?php echo $item["cart_id"]; ?>">
                                            <button type="submit" class="quant-button" name="quant-up-button"><i class="fas fa-angle-up"></i></button>
                                        </form>
                                        <input type="text" placeholder="<?php echo $item["quantity"]; ?>">
                                        <form method="post">
                                            <input type="hidden" name="quant-down" value="<?php echo $item["cart_id"]; ?>">    
                                            <button type="submit" class="quant-button" name="quant-down-button"><i class="fas fa-angle-down"></i></button>
                                        </form>
                                        <form method="post">
                                            <input type="hidden" name="cart_id" value="<?php echo $item["cart_id"]; ?>">
                                            <button type="submit" name="delete-cart-item" class="btn text-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="cart-column-price">
                                    <h4 class="text-danger"><?php echo $product_data["item_price"]; ?></h4>
                                </div>
                            </div> 
                            <hr class="hr">
                            <?php } ?>
                        </div>
                        <div class="order-summary px-4">
                            <div class="border py-3 px-3 text-center">
                                <h5 class="text-success">Your order is eligible for free delivery</h5>
                            </div>
                            <div class="border text-center">
                                <div class="total-price pt-3">
                                    <h5>Total price : </h5> 
                                    <h5 class="text-danger">$ <?php echo $total_price ?></h5>
                                </div>
                                <div class="py-4">
                                    <form method="post">
                                        <input type="hidden" name="total-price" value="<?php echo $total_price ?>">
                                        <button name="proceed-to-buy" class="btn btn-warning font-size-18">Proceed to buy</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- !Shopping cart section  -->
