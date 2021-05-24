<!-- Payment-success -->
<section id="payment-success">
    <div class="container text-center" style="margin-top: 50px">
        <h4 class="text-success">Your order has been Successfully placed</h4>
        <h5>Transaction ID : <?php echo $_SESSION["transaction_id"] ?></h5>
        <a href="<?php echo 'index.php' ?>" class="btn btn-primary">Return to Home</a>
    </div>
</section>
<!-- !Payment-success -->