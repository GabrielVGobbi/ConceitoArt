<?php if ($this->userInfo['user']->hasPermission('dashboard_view')) : ?>
  <div class="container">
    <div class="row">

      <div class="col-lg-4 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $getCountInventario; ?></h3>

            <p>Obras Cadastradas</p>
          </div>
          <div class="icon">
            <i class="ion ion-images"></i>
          </div>
          <a href="<?php echo BASE_URL?>inventario" class="small-box-footer">Veja mais <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $getCountArtista; ?></h3>

            <p>Artistas Cadastrados</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-people-outline"></i>
          </div>
          <a href="<?php echo BASE_URL?>artistas" class="small-box-footer">Veja mais <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $getCountObraMercadolivre; ?></h3>

            <p>Obras Mercado livre</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-people-outline"></i>
          </div>
          <a href="#" class="small-box-footer">Veja mais <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>
    <div class="row">
    <!-- <div class="col-lg-3 col-xs-6">
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Obras vendidas (Bomblo Leiloes)</span>
          <span class="info-box-number">R$ <?php echo number_format($getCountobrasSales, 2, ',', '.'); ?></span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
            70% Increase in 30 Days
          </span> 
        </div>

      </div> -->
    </div>
  </div>
  </section>
<?php endif; ?>