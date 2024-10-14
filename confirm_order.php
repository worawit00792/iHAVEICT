<?php include('h.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <style type="text/css">
		input[type=number]{
			width:40px;
			text-align:center;
			color:red;
			font-weight:600;
		}
	</style>
  </head>
  <body>
  <div class="container">
  <div class="row">
         <?php include('banner.php');?>
   </div>
  	<div class="row">
    	<div class="col-md-12">
        	<?php include('navbar.php');?>
        </div>
    </div>
 </div> 
 <!--start show  product-->
 <div class="container">
 	<div class="row">
    	<!-- categories-->
    	<div class="col-md-2">
        	<?php include('category.php');?>
        </div>
        <!-- product-->
        <div class="col-md-10">
         	 <?php  include('order.php');?>
        </div>
    </div>
</div>
 <!--end show  product-->
 
 
 
 
 
  </body>
</html>
<?php include('f.php');?>