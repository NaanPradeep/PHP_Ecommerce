<?php  
    $user_data = $auth->check_login();
    $ship_address = $shipAddress->get_ship_address_by_id($_SESSION["shipping_address"]);
    $bill_address = $billAddress->get_bill_address_by_id($_SESSION["billing_address"]);

    require 'vendor/autoload.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["place-order"])) {
            $merchant_id = ''; //your merchant ID (must be a 9 digit string)
            $payments_api_key = ''; //payments-specific API passcode
            $api_version = 'v1'; //default
            $platform = 'www'; //default

            //Create Beanstream Gateway
            $beanstream = new \Beanstream\Gateway($merchant_id, $payments_api_key, $platform, $api_version);

            $profile_id = $_SESSION["profile_id"];
            $profile_payment_data = array(
                'order_number' => "abc123",
                'amount' => 75.50
            );
            try {
                $result = $beanstream->payments()->makeProfilePayment($profile_id, 1, $profile_payment_data, FALSE); // FALSE for Pre-Auth
                $transaction_id = $result['id'];
                // complete payment
                $result = $beanstream->payments()->complete($transaction_id, 12.5);
            } catch (\Beanstream\Exception $e) {
                //todo handle exception
            }
            $_SESSION["transaction_id"] = $transaction_id;
            if(isset($_SESSION["transaction_id"])) {
                $post_data["user_id"] = $user_data["user_id"];
                $post_data["serialized_product_details"] = serialize($_SESSION["checkout_products"]);
                $post_data["order_total"] = $_SESSION["total_price"];
                $post_data["transaction_id"] = $_SESSION["transaction_id"];
                $post_data["ship_address"] = $_SESSION["shipping_address"];
                $post_data["bill_address"] = $_SESSION["billing_address"];
                $post_data["status"] = "Ready to ship";
                $cart->empty_cart($user_data["user_id"]);
                $result = $order->post_order_details($post_data);
                if($result) {
                    header("Location: payment-success.php");
                }
            }
        }
    }
?>


<!-- Confirm Payment -->

<section id="confirm-payment">
    <div class="confirm-payment-container">
        <div class="ship-bill-address-container">
            <div class="address-card">
                <h4>Billing Address</h4>
                <hr>
                <h5><?php echo $user_data["user_name"] ?></h5>
                <h6><?php echo $bill_address["street_no"] ?></h6>
                <h6><?php echo $bill_address["street_name"] ?></h6>
                <h6><?php echo $bill_address["town_name"] ?></h6>
                <h6><?php echo $bill_address["city_name"] ?></h6>
                <h6><?php echo $bill_address["pincode"] ?></h6>
                <h6><?php echo $bill_address["country"] ?></h6>
            </div>
            <div class="address-card">
                <h4>Shipping Address</h4>
                <hr>
                <h5><?php echo $user_data["user_name"] ?></h5>
                <h6><?php echo $ship_address["street_no"] ?></h6>
                <h6><?php echo $ship_address["street_name"] ?></h6>
                <h6><?php echo $ship_address["town_name"] ?></h6>
                <h6><?php echo $ship_address["city_name"] ?></h6>
                <h6><?php echo $ship_address["pincode"] ?></h6>
                <h6><?php echo $ship_address["country"] ?></h6>
            </div>
        </div>
        <div class="checkout-products-container">
            <?php foreach($_SESSION["checkout_products"] as $checkout_item) { ?>
            <div class="checkout-products">
                <img class="checkout-products-img" src="<?php echo $checkout_item["item_image"] ?>" alt="product">
                <div class="checkout-products-details">
                    <h4><?php echo $checkout_item["item_name"] ?></h4>
                    <h6><?php echo $checkout_item["item_brand"] ?></h6>
                    <h6>Price : $<?php echo $checkout_item["item_price"] ?></h6>
                    <h6>Quantity : <?php echo $checkout_item["quantity"] ?></h6>
                    <h6>Total : $<?php echo $checkout_item["order_price"] ?></h6>
                </div>
            </div>
            <?php } ?>
            <hr>
            <div class="total-price-box">
                <img class="total-price-img" src="https://barracudamsp.com/images/icons/icon-total-price-control.png" alt="">
                <div class="total-price-details">
                    <div class="total-price">
                        <h4>Total price :</h4>
                        <h4 class="ml-10"> $<?php echo $_SESSION["total_price"] ?></h4>
                    </div>
                    <form method="post">
                        <button type="submit" name="place-order" class="place-order-btn btn-warning">Place your Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Confirm Payment -->