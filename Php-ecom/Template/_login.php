<?php 

    $email_error = "";
    $password_error="";
    $error = "";

    $user_email = $password = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["email"])) {
            $email_error = "Fill in with your email address";
        } else {
            $user_email = clean_data($_POST["email"]);
        }

        if(empty($_POST["password"])) {
            $password_error = "Fill in with your password";
        } else {
            $password = clean_data($_POST["password"]);
        }
    }

    $post_data["user_email"] = $user_email;
    $post_data["password"] = $password;

    if($post_data["user_email"] !== "" && $post_data["password"] !== "") {
        $query = $auth->login($post_data);
        $_SESSION["user_id"] = $query["user_id"];
        header("Location: index.php");
        die();
    }

    function clean_data($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<!-- Login -->
<section id="register-form">
    <div class="register-container">
        <div class="form-flex">
        <h4>Login</h4>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="inline-flex">
                <span class="text-danger"><?php echo $email_error;?></span>
                E-mail: <input class="form-input" type="text" name="email">
                <span class="text-danger"><?php echo $password_error;?></span>
                Password: <input class="form-input" type="password" id="pwd" name="password">
                <input class="submit btn-primary" type="submit">
                <p>Don't have an account, <a href="<?php echo 'register.php' ?>">Register</a> here</p>
            </div>
        </form>
        </div>
    </div>
</section>
<!-- Register -->