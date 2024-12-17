<div class="card">
  <img src="assets/img/laptop.jpg" class="card-img-top" alt="laptop">
    <div class="card-body">
      
      <?php if(isset($produkt->artikel)): ?>
      <b style="font-size: 25px;"><?= $produkt->artikel ?></b>
      <?php endif; ?>   

      <?php if(isset($produkt->preis)): ?>
        <p style="font-size: 20px;"><?= number_format($produkt->preis, 2) ?>&nbsp;€</p>
      <?php endif; ?>
      <div class="card-footer">
      </div>
    </div>
</div>
