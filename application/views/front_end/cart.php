<?php
$user_data=$this->session->all_userdata();
$cart_contents=$this->cart->contents();
?>
<div id="cart_list" class="item fullwidth" style="background-color: white !important;">
	<div class="container">
		<div class="row">
			<div class="col-md-12 content_text">
				<h2>My Order</h2>
				<div class="clearfix pad_top13">
				<style>
				table tr
				{
					
				}
				table #cart_list td{
					padding:2em !important;
					border-top:1px solid #dddddd;
					border-bottom:1px solid #dddddd;
				}
				input
				{
					border:none !important;
				}
				</style>	
				<?php
				if($cart_contents){
				?>		  	
					<div class="col-md-12">
						<table class="table" id="cart_list">
							
							<?php $total=0;
							foreach($cart_contents as $key=>$cartcontent)
							{
								$total=$total+$cartcontent['subtotal'];
								?>
								<tr>
									<td ><img class="img" width="80" src="<?php echo $cartcontent['image'];?>" /></td>
									<td><?php echo $cartcontent['name']; ?></td>
									<td>
										<a onclick="decrease('<?php echo $cartcontent['rowid'];?>',<?php echo $cartcontent['id'];?>)" style="float: left;margin-right:1em;" class="btn btn-info">
											<i class="fas fa-minus"></i>
										</a>
										<input id="qty<?php echo $cartcontent['id'];?>" value="<?php echo $cartcontent['qty'];?>" type="number" class="" readonly="" style="width: 30px;float: left;margin-right:1em;height:2.5em;text-align:center;" />
										<input type="hidden" id="qty_demo<?php echo $cartcontent['id'];?>" value="" />
										<a onclick="increase('<?php echo $cartcontent['rowid'];?>',<?php echo $cartcontent['id'];?>)" style="float: left;margin-right:1em;" class="btn btn-info">
											<i class="fas fa-plus"></i>
										</a>
									</td>
									<td>QAR.&nbsp;<span id="price"><?php echo number_format($cartcontent['subtotal'],2);?></span></td>
									<td><p onclick="remove_cart('<?php echo $cartcontent['rowid'];?>')" class="btn btn-danger">X</p></td>
								</tr>
								<?php
							}
							?>
							<tr>
								<th>Subtotal</th><th>Qr. <?php echo $total;?></th><th colspan="3"></th>
								
							</tr>
							<tr><th>Delivery Charges</th><th>0</th><th colspan="3"></th></tr>
							<tr>
								<th>Total</th>
								<th>Qr. <?php echo number_format($this->cart->total(),2); ?></th>
								<th colspan="3"></th>
							</tr>
							
						</table>
						<div class="col-md-6 col-sm-6">
							<a href="<?php echo base_url(); ?>menu"><button class="genric-btn primary-border">Add More Items</button></a>
						</div>
						<?php
						if(isset($user_data['user_id']))
						{
						?>
						<div class="col-md-6 col-sm-6">
							<a href="<?php echo base_url(); ?>checkout" class="genric-btn primary">Checkout</a>
						</div>
						<?php  
						}
						else
						{
						?>
						<div class="col-md-6 col-sm-6 text-right">
							 <a href="<?php echo base_url(); ?>login" class="genric-btn primary">Checkout</a>
						</div>	 
						<?php   
						}
						?>		
					</div>
				   <?php
				   }
				   else
				   {
					echo 'No Orders';
				   }
				   ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    function increase(i,j)
    {
        var qty=$("#qty"+j).val();
        var new_qty=Number(qty)+1;
        $("#qty"+j).val(new_qty);
        $("#qty_demo"+j).val(new_qty);
        $.ajax({
            type:'post',
            data:'qty='+new_qty+'&rowid='+i,
            url:'Frontend/update_cart',
            success:function(data)
            {
				alert(data);
				location.reload(); 
            }
        });
    }
    function decrease(i,j)
    {
        var qty=$("#qty"+j).val();
        var new_qty=Number(qty)-1;
        $("#qty"+j).val(new_qty);
        $("#qty_demo"+j).val(new_qty);
        $.ajax({
            type:'post',
            data:'qty='+new_qty+'&rowid='+i,
            url:'Frontend/update_cart',
            success:function(data)
            {
				alert(data);
				location.reload(); 
            }
        });
    }
    function remove_cart(i)
    {
        $.ajax({
            type:'post',
            data:'rowid='+i,
            url:'Frontend/remove_cart',
            success:function(data)
            {
              	alert(data);
				location.reload();
            }
        });
    }
</script>