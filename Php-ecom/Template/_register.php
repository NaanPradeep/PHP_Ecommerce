<?php 

   $name_error = $email_error = $password_error = ""; 
   $user_name = $email = $password = "";
   $post_message = "";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
       // checking if the user name is empty
       if(empty($_POST["user_name"])) {
           $name_error = "* User Name is required";
       } else {
           $user_name = clean_data($_POST["user_name"]);
       }
       // checking if the email field is empty
       if(empty($_POST["email"])) {
        $email_error = "* Email is required";
        } else {
            $email = clean_data($_POST["email"]);
            //checking if the email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_error = "Invalid email format";
            }
        }
        //checking if either password field is empty
        if(empty($_POST["password"]) || empty($_POST["confirm_password"])) {
            $password_error = "* Password field is required";
        } else {
            // checking if the passwords matches
            if($_POST["password"] !== $_POST["confirm_password"]) {
                $password_error = "Password doesn't match";
            } else {
                $password = clean_data($_POST["password"]);
            }
        }
   }

   if($user_name !== "" && $email !== "" && $password !== "") {
       $post_data['user_name'] = $user_name;
       $post_data['email'] = $email;
       $post_data['password'] = $password; 
       $post_message = $auth->post_register_data($post_data);
       header("Location: login.php");
       die();
   }

   function clean_data($data) {
       $data = trim($data);
       $data = stripcslashes($data);
       $data = htmlspecialchars($data);
       return $data;
   }


?>

<!-- Register -->
<section id="register-form">
    <div class="register-container">
        <div class="form-flex">
        <h4>Register</h4>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="inline-flex">
                <h6 class="text-danger"><?php echo $post_message;?></h6>
                <span class="text-danger"><?php echo $name_error;?></span>
                User Name: <input class="form-input" type="text" value="<?php echo $user_name;?>" name="user_name">
                <span class="text-danger"><?php echo $email_error;?></span>
                E-mail: <input class="form-input" type="text" value="<?php echo $email;?>" name="email">
                <span class="text-danger"><?php echo $password_error;?></span>
                Password: <input class="form-input" type="password" id="pwd" name="password">
                <span class="text-danger"><?php echo $password_error;?></span>
                Confirm Password: <input class="form-input" type="password" id="pwd" name="confirm_password">
                <input class="submit btn-primary" type="submit">
                <p>Already have an account, <a href="">Login</a> here</p>
            </div>
        </form>
        </div>
    </div>
</section>
<!-- Register -->