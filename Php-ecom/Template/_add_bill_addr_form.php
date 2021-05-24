<?php 
    $streetno_error = $streetname_error = $townname_error = $cityname_error =  "";
    $pincode_error = $country_error = "";

    $user_data = $auth->check_login();
    print_r($user_data["user_id"]);

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty($_POST["street_no"])) {
            $streetno_error = "Please enter your street number";
        } else {
            $post_data["street_no"] = $_POST["street_no"];
        }

        if(empty($_POST["street_name"])) {
            $streetname_error = "Please enter your street name";
        } else {
            $post_data["street_name"] = $_POST["street_name"];
        }

        if(empty($_POST["town_name"])) {
            $townname_error = "Please enter your town name";
        } else {
            $post_data["town_name"] = $_POST["town_name"];
        }

        if(empty($_POST["city_name"])) {
            $cityname_error = "Please enter your city name";
        } else {
            $post_data["city_name"] = $_POST["city_name"];
        }

        if(empty($_POST["pin_code"])) {
            $pincode_error = "Please enter your Pincode";
        } else {
            $post_data["pincode"] = $_POST["pin_code"];
        }

        if(empty($_POST["country"])) {
            $country_error = "Please enter your Country";
        } else {
            $post_data["country"] = $_POST["country"];
            $post_data["address_owner"] = $_POST["address_owner"];
        }
        if(!empty($_POST["street_no"]) && !empty($_POST["street_name"]) && !empty($_POST["town_name"]) && !empty($_POST["city_name"]) && !empty($_POST["pin_code"]) && !empty($_POST["country"]) && !empty($_POST["address_owner"])) {
            $result = $billAddress->post_billing_address($post_data);
            if($result) {
                header("Location: add_address_form.php");
            }
        }
    }
?>


<!-- Add Billing Address -->
<section id="register-form">
    <div class="register-container">
        <div class="form-flex">
        <h4>Add Billing Address</h4>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="inline-flex">
                <input type="hidden" name="address_owner" value="<?php echo $user_data["user_id"] ?>">
                <span class="text-danger"><?php echo $streetno_error;?></span>
                Street No: <input class="form-input" type="text" name="street_no">
                <span class="text-danger"><?php echo $streetname_error;?></span>
                Street Name: <input class="form-input" type="text" name="street_name">
                <span class="text-danger"><?php echo $townname_error;?></span>
                Town: <input class="form-input" type="text" name="town_name">
                <span class="text-danger"><?php echo $cityname_error;?></span>
                City: <input class="form-input" type="text" name="city_name">
                <span class="text-danger"><?php echo $pincode_error;?></span>
                Pincode: <input class="form-input" type="text" name="pin_code">
                <span class="text-danger"><?php echo $country_error;?></span>
                Country: <input class="form-input" type="text" name="country">
                <input type="submit" value="Add address" class="submit btn-primary">
            </div>
        </form>
        </div>
    </div>
</section>
<!-- Add Billing Address -->