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
        if(isset($_POST["street_no"]) && isset($_POST["street_name"]) && isset($_POST["town_name"]) && isset($_POST["city_name"]) && isset($_POST["pin_code"]) && isset($_POST["country"]) && isset($_POST["address_owner"])) {
            print_r("working");
            $shipAddress->post_ship_address($post_data);
        }
    }
?>


<!-- Add Ship Address -->
<section id="register-form">
    <div class="register-container">
        <div class="form-flex">
        <h4>Add Shipping Address</h4>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="inline-flex">
                <input type="hidden" name="address_owner" value="<?php echo $user_data["user_id"] ?>">
                Street No: <input class="form-input" type="text" name="street_no">
                Street Name: <input class="form-input" type="text" name="street_name">
                Town: <input class="form-input" type="text" name="town_name">
                City: <input class="form-input" type="text" name="city_name">
                Pincode: <input class="form-input" type="text" name="pin_code">
                Country: <input class="form-input" type="text" name="country">
                <input type="submit" value="Add address" class="submit btn-primary">
            </div>
        </form>
        </div>
    </div>
</section>
<!-- Add Ship Address -->