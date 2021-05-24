<?php 
  $all_products = $product->get_data();
?>

<?php 
  $all_brands = array_map(function($prdct){return $prdct['item_brand'];}, $all_products);
  $unique_brands = array_unique($all_brands);
  sort($unique_brands);
?>

<!-- special-prize -->
<section id="special-prize">
          <div class="container">
            <h4 class="font-rubik font-size-20">Special Prizes</h4>
            <div id="filters" class="button-group text-end">
                <button class="btn is-checked" data-filter="">All Brands</button>
                <?php array_map(function($brand){
                  printf('<button class="btn" data-filter=".%s">%s</button>',$brand, $brand);
                }, $unique_brands); ?>

            </div>
            <div class="d-flex flex-wrap">
              <div class="justify-content-center">
              <?php foreach($all_products as $item) { ?>
                <div style="width: 200px;" class="item py-2 border <?php echo $item['item_brand'] ?>">
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
                        <button type="submit" name="index" class="btn btn-warning font-size-12">Add to Cart</button>
                      </form>
                    </div>
                  </div>
                </div>
              <?php } ?>
              </div>
            </div>
            </div>
        </section>
        <!-- !special-prize -->