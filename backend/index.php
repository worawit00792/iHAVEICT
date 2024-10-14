<?php include('access.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('h.php');?>
    <?php include('datatable.php');?>
    
  </head>
  <body>
    <div class="container">
      <div class="row">
        <span id="hp">
          <?php include('banner.php');?>
        </span>
      </div>
      <div class="row">
        <div class="col-md-2">
          <b>  ADMIN : <?php include('mm.php');?> </b>
          <br>
          <span id="hp">
            <?php include('menu.php');?>
          </span>
          
        </div>
        <div class="col-md-10">
          <br>
          <span id="hp">
          <a href="index.php" class="btn btn-primary"> รายการใหม่ </a>
          <a href="index.php?act=show-payed" class="btn btn-info"> ชำระเงินแล้ว </a>
          <a href="index.php?act=show-post" class="btn btn-success"> ส่งของแล้ว </a>
        </span>

          <br> <br>
          <?php
              $act = $_GET['act'];
              if($act=='show-order'){
                include('detail_order_afer_cartdone.php');
              }elseif($act=='show-payed'){
                include('show_cart_pay.php');
              }elseif($act=='show-post'){
                include('show_cart_post.php');
              }else{
                include('show_new_cart.php');
              }
              
          
              
              
          ?>
          
          
        </div>
      </div>
    </div>
  </body>
</html>
<?php include('f.php');?>