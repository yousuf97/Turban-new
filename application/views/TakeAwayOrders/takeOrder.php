<?php  ?>
<section class="menu-list" id="ui_menu_list">

	<div class="container">
		<div class="row">
			<div></div>
			<div class="col-md-12">
				<div>
					<h2 class="text-center ">
						<img src="<?php echo base_url('front/img/nizami-logo.png'); ?>"/>
					</h2>
					<a href="Auth/logout"><h5 style="position:absolute;top:0;"  id="user_logout">Logout</h5></a>
				</div>
				

				<div class="panel-group" id="accordion">
				<?php foreach ($category as $c => $ct): ?>
					<div class="panel panel-default">
					<a data-toggle="collapse" data-parent="#accordion" href="#cat<?php echo $ct['id']; ?>">
						<div class="panel-heading">
							<h4 class="panel-title">
								<?php echo $ct['name']; ?>
							</h4>
						</div>
						</a>
						<div id="cat<?php echo $ct['id']; ?>" class="panel-collapse collapse">
							<div class="panel-body">
							<?php
								$sub_cats = $this->model_getrows->get_product_by_Catid($ct['id']); 
								echo '<table class="table">';
								foreach ($sub_cats as $sub_cat => $sc):
									$products = $this->model_getrows->get_product_by_SubCatid($sc->id); 
									foreach ($products as $product => $p):
							?>
									<tr> 
										<td><?php echo $p->name; ?></td>
										<td>Qr.<?php echo $p->price; ?></td>
										<td><a onclick="order_now(<?php echo $p->id;?>)"><i class="fa fa-plus-circle text-success"></i></a></td>
									</tr>
							<?php		
								 	endforeach;
								endforeach;
								echo '</table>';
							?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>	
				</div>
			</div>
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
       url:'./User_interface/save_cart',
       success:function(result)
       {

            $( ".main-footer .total_price" ).html(result);
            $( ".modal-cart-total" ).html(result);

       }
    });
}
</script>