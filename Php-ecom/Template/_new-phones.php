<?php 
  $all_products = $product->get_data();

?>

<!-- New Phone carousel -->
<section id="new-phone">
          <div class="container py-5">
            <h4 class="font-rubik font-size-20">New Phone</h4>
            <hr>
            <div class="owl-carousel owl-theme">
            <?php foreach($all_products as $item) { ?>
              <div class="item py-2">
                <div class="product font-raleway">
                  <a href="<?php printf('%s?item_id=%s', 'product.php', $item['item_id']) ?>"><img src="<?php echo $item['item_image'] ?? "./assets/products/1.png" ?>" alt="product1" class="img-fluid"></a>
                  <div class="text-center">
                    <h6><?php echo $item['item_name'] ?? "Empty" ?></h6>
                    <div class="rating text-warning font-size-12">
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="far fa-star"></i></span>
                    </div>
                    <div class="price py-2">
                      <span><?php echo $item['item_price'] ?? "0.00" ?></span>
                    </div>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                      <input type="hidden" name="item_id" value="<?php echo $item["item_id"] ?>">
                      <button type="submit" name="new-phone-submit" class="btn btn-warning font-size-12">Add to Cart</button>
                    </form>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>
          </div>
        </section>
        <!-- !New Phone carousel -->