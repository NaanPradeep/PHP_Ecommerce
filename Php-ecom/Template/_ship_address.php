<?php 

    $user_data = $auth->check_login();
    $select_success_message = "";
    if(isset($_SESSION["user_id"])) {
        $ship_addresses = $shipAddress->get_ship_address($_SESSION["user_id"]);
        $billing_address = $billAddress->get_billing_address($user_data["user_id"]);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["select-address"])) {

            if(isset($_POST["address_id"]) && isset($billing_address)) {
                $_SESSION["shipping_address"] = $_POST["address_id"];
                $_SESSION["billing_address"] = $billing_address["address_id"];
                if(isset($_SESSION["shipping_address"]) && isset($_SESSION["billing_address"])) {
                    header("Location: custom_checkout.php");
                }
            } else {
                header("Location: add_bill_addr_form.php");
            }
        }
    }


?>

<!-- Shipping Adress -->
<section id="ship-address">
    <div class="address-container">
    <?php if(isset($billing_address)) { ?>
    <div class="address-card">
            <h3>Billing Address<h3>
            <hr>
            <h4><?php echo $user_data["user_name"]; ?></h4>
            <h6><?php echo $billing_address["street_no"]; ?></h6>
            <h6><?php echo $billing_address["street_name"]; ?></h6>
            <h6><?php echo $billing_address["town_name"]; ?></h6>
            <h6><?php echo $billing_address["city_name"]; ?></h6>
            <h6><?php echo $billing_address["pincode"]; ?></h6>
            <h6><?php echo $billing_address["country"]; ?></h6>
        </div>
    <?php } ?>
    <?php foreach($ship_addresses as $address) { ?>
        <div class="address-card">
            <h4><?php echo $user_data["user_name"]; ?></h4>
            <h6><?php echo $address["street_no"]; ?></h6>
            <h6><?php echo $address["street_name"]; ?></h6>
            <h6><?php echo $address["town_name"]; ?></h6>
            <h6><?php echo $address["city_name"]; ?></h6>
            <h6><?php echo $address["pincode"]; ?></h6>
            <h6><?php echo $address["country"]; ?></h6>
            <form method="post">
                <input type="hidden" name="address_id" value="<?php echo $address["address_id"] ?>">
                <button class="submit btn-primary" type="submit" name="select-address">Select Ship Address</button>
            </form>
        </div>
    <?php } ?>
        <div class="add-address-card">
            <a style="text-align: center" href="<?php echo "add_address_form.php" ?>">
            <img class="add-address" src="https://cdn4.iconfinder.com/data/icons/essential-6/512/add-512.png" alt="add"><br/>
            Add Ship Address
            </a>
        </div>
    </div>
</section>

<!-- !Shipping Adress -->