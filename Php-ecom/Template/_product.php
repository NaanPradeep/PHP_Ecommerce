<?php 
    $all_products = $product->get_data();
    $item_id = $_GET['item_id'] ?? 1;
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["add-cart-product"])) {
            if(empty($_POST["user_id"])) {
                header("Location: login.php");
              } else {
                $user_id = $_POST["user_id"];
                $item_id = $_POST["item_id"];
              }
              $cart->add_to_cart($user_id, $item_id);
            }
        }
        
    foreach($all_products as $item):
        if($item['item_id'] == $item_id):
?>

<!-- Product-detail -->
<section id="product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 product-img">
                        <img src="<?php echo $item['item_image'] ?? "./assets/products/1.png" ?>" alt="product1" class="img-fluid" style="width: 550px;">
                        <div class="form-row d-flex justify-content-between font-baloo">
                            <div class="col">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <?php if(!empty($_SESSION["user_id"])) { ?>
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                <?php } else { ?>
                                <input type="hidden" name="user_id" value="<?php echo "" ?>">
                                <?php } ?>
                                <input type="hidden" name="item_id" value="<?php echo $item["item_id"] ?>">
                                <button type="submit" name="add-cart-product" class="btn btn-warning font-size-20">Add To Cart</button>
                            </form>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary font-size-20">Proceed To Buy</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 product-text mt-5">
                        <h4 class="font-baloo font-size-25"><?php echo $item['item_name'] ?? "Empty" ?></h4>
                        <small class="font-size-16">by <?php echo $item['item_brand'] ?? "Empty" ?></small>
                        <div class="d-flex rating">
                            <div class="text-warning font-size-16">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <a href="#" class="font-size-16 font-raleway px-2 text-decoration-none">20,534 ratings | 1000+ answered questions</a>
                        </div>
                        <hr class="hr-1">
                        <table class="my-1">
                            <tr class="font-raleway font-size-18">
                                <td >Price :</td>
                                <td class="px-4 font-monospace"><strike>$162</strike></td>
                            </tr>
                            <tr class="font-raleway font-size-18">
                                <td class="font-size-18">Deal Price :</td>
                                <td class="px-4 font-monospace text-danger"><?php echo $item['item_price'] ?? "Empty" ?><small class="text-black-50 font-size-14">(Inclusive of all taxes)</small></td>
                            </tr>
                            <tr class="font-raleway font-size-20">
                                <td class="font-size-18">You Save :</td>
                                <td class="px-4 font-monospace text-danger">$10</td>
                            </tr>
                        </table>
                        <!-- Policy -->
                        <div id="policy">
                            <div class="d-flex">
                                <div class="text-center">
                                    <div class="font-size-20 my-2">
                                        <span class="fas fa-retweet bg-light border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-size-16 font-rubik text-decoration-none">10 Days <br>Replacement</a>
                                </div>
                                <div class="text-center px-5">
                                    <div class="font-size-20  my-2">
                                        <span class="fas fa-truck bg-light border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-size-16 font-rubik text-decoration-none">Delivered <br>Fast Delivery</a>
                                </div>
                                <div class="text-center">
                                    <div class="font-size-20  my-2">
                                        <span class="fas fa-check-double bg-light border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-size-16 font-rubik text-decoration-none">One Year <br>Warranty</a>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-2">
                        <!-- !Policy -->

                        <!-- Order Details -->
                        <div id="order-details" class="font-size-16 d-flex flex-column">
                            <p class="mb-0">Estimated deliver date : Mar 29 - Apr 1</p>
                            <p class="mb-0">Sold by <a href="#">Pradeep Electronics</a>(4.5 out of 5 | 18,198 ratings)</p>
                            <p><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to customer - 622407</p>
                        </div>
                        <hr class="hr-3">
                        <!-- !Order Details -->

                   <div class="col-lg-12 my-4">
                        <h6 class="font-baloo font-size-20">Specification :</h6>
                        <div class="d-flex justify-content-between">
                            <div class="font-rubik p-2">
                                <button type="button" class="btn btn-secondary">4GB RAM</button>
                            </div>
                            <div class="font-rubik p-2">
                                <button class="btn btn-secondary">6GB RAM</button>
                            </div>
                            <div class="font-rubik p-2">
                                <button class="btn btn-secondary">8GB RAM</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="margin-top: 70px;">
                    <h6 class="font-rubik  font-size-20">Product Description</h6>
                            <hr>
                            <p class="font-rale font-size-18">Lorem ipsum dolor, sit amet consectetur 
                                adipisicing elit. Repellat inventore vero numquam error est ipsa, consequuntur 
                                temporibus debitis nobis sit, delectus officia ducimus dolorum sed corrupti. 
                                Sapiente optio sunt provident, accusantium eligendi 
                                eius reiciendis animi? Laboriosam, optio qui? Numquam, quo fuga. 
                                Maiores minus, accusantium velit numquam a aliquam vitae vel?</p>
                            <p class="font-rale font-size-18">Lorem ipsum dolor, sit amet consectetur adipisicing 
                                elit. Repellat inventore vero numquam error est ipsa, consequuntur temporibus debitis 
                                nobis sit, delectus officia ducimus dolorum sed corrupti. Sapiente optio sunt provident, 
                                accusantium eligendi eius reiciendis animi? Laboriosam, optio qui? Numquam, quo fuga. 
                                Maiores minus, accusantium velit numquam a aliquam vitae vel?</p>
                </div>
            </div>
</section>
<!-- Product-detail -->

<?php 
    endif;
    endforeach;
?>
