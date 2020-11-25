<?php $model=new Model_getrows(); ?>
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb_iner text-center">
					<div class="breadcrumb_iner_item">
						<h2>Food Menu</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- breadcrumb end-->
<!-- menu start-->
<section class="food_menu">
    <div class="container gray_bg p-5">
		<div class="row">
			<?php 
				$cat_ids = $model->get_product_by_Catid($id); 
				foreach ($cat_ids as $cat_id=>$value) {
			?>					
			<div class="col-md-12 col-sm-12 col-lg-12">
				<h2><?php echo $value->name; ?></h2>
				<?php 
					$data = $model->get_product_by_SubCatid($value->id); 
					foreach ($data as $d=>$v) {
				?>
				<div class="col-md-6 col-sm-6 col-lg-6">
				<div class="single_food_item media">
					<img src="<?php echo base_url().$v->image; ?>" class="mr-3" alt="...">
					<div class="media-body align-self-center">
						<h3><?php echo $v->name; ?></h3>
						<h5><?php echo 'QAR. '.$v->price; ?></h5>
						<a class="genric-btn primary small" style="color:#fff" onclick="order_now(<?php echo $v->id;?>)">Add To Cart</a>
					</div>
				</div>
				</div>
				<?php } ?>
			</div>
			<?php } ?>	
		</div>
	</div>
</section>

<script>
function order_now(item_id)
{
    //add to cart
    $.ajax({
       type:'POST',
       data:'item_id='+item_id,
       url:'../Frontend/save_cart',
       success:function(data)
       {
		   alert(data);
		   location.reload(true); 
       }
    });
}
</script>