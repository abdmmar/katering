<?php
$jmlMenu = 1;
?>

<div class="container-cart">
  <div>
    <div class="list-item-container">
      <h2>Keranjang Belanja</h2>
      <div class="list-item">
        <div class="item">
          <img src="../../uploads/asnim-ansari-SqYmTDQYMjo-unsplash.jpg" alt="Menu">
          <div class="item-info">
            <p>Grilled Cheese Sandwich</p>
            <p class="label-harga">
              <strong>
                Rp<span class="harga">15000</span>
              </strong>
            </p>
            <form method="post" class="item-increment">
              <button class="btn-minus">
                <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=minus&fill=ffffff" width="18" height="18"></svg>
              </button>
              <!-- <input type="button" class="btn-minus" name="btn-minus" value="-" /> -->
              <input type="text" class="total" value="<?php echo $jmlMenu ?>" />
              <button class="btn-plus">
                <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=plus&fill=ffffff" width="18" height="18"></svg>
              </button>
              <!-- <input type="button" id="btn-plus" class="btn-plus" name="btn-plus" value="+" /> -->
            </form>
          </div>
          <div class="btn-delete">
            <a class="icon" href="#">
              <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=trash&fill=767676" width="24" height="24"></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="shopping-summary">
      <h3>Ringkasan Belanja</h3>
      <div class="total-price">
        <div class="label">Total Harga</div>
        <p class="label-harga">
          <strong>
            Rp<span class="harga">15000</span>
          </strong>
        </p>
      </div>
      <a href="dashboard.php?p=checkout">
        <button class="beli">
          <strong>Beli</strong>
        </button>
      </a>
    </div>
  </div>
</div>
<script type="text/javascript">
  const btnMinus = document.querySelector(".btn-minus");
  const btnPlus = document.querySelector(".btn-plus");

  btnMinus.addEventListener("click", function(e) {
    e.preventDefault();
    let jmlMenu = document.querySelector(".total");
    if (jmlMenu.value > 1) {
      jmlMenu.value--;
    }
  });

  btnPlus.addEventListener("click", function(e) {
    e.preventDefault();
    let jmlMenu = document.querySelector(".total");
    jmlMenu.value++;
  });
</script>