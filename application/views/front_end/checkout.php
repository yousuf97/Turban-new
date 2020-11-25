<?php
 $user_data=$this->session->all_userdata();
 $cartcontents=$this->cart->contents(); #print_r($cartcontents);
if(($user_data['log_in']==1))
{
    $name=$user_data['user_name'];
    $email=$user_data['user_email'];
    $phone=$user_data['user_contact'];
    $address='';
    
}
else
{
    $name='';
    $email='';
    $phone='';
    $address='';
}
?>
<section class="checkout_part">
	<div class="container">
		<div class="row">
			<div class="col-md-4 order-md-2 mb-4">
			  <h2>Your cart<span class="badge badge-secondary badge-pill"><?php echo $this->cart->total_items();?></span></h2>
			  <ul class="list-group mb-3">
				<?php foreach($cartcontents as $cc) { ?>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
				  <div>
					<h6 class="my-0"><?php echo $cc['name'];?></h6>
				  </div>
				  <span class="text-muted"><?php echo $cc['price'];?> x<?php echo $cc['qty'];?></span>
				</li>
				<?php } ?>
				<li class="list-group-item d-flex justify-content-between">
				  <span>Total (QR)</span>
				  <strong> <?php echo $this->cart->format_number($this->cart->total()); ?></strong>
				</li>
			  </ul>
			</div>
			<div class="col-md-8 order-md-1">
			  <h2>Billing address</h2>
			  <form id="Checkout_form" method="post" class="needs-validation" action="Frontend/checkout_action" >
				<div class="row">
				  <div class="col-md-6 mb-3">
					<label for="firstName">Full Name</label>
					<input type="text" class="form-control" name="checkout[name]" id="firstName" placeholder="" value="<?php echo $name;?>" required>
					<div class="invalid-feedback">
					  Valid first name is required.
					</div>
				  </div>
				  <div class="col-md-6 mb-3">
				  <label for="email">Email</label>
				  <input type="email" name="checkout[email]" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $email;?>" required>
				  <div class="invalid-feedback">
					Please enter a valid email address for shipping updates.
				  </div>
				</div>
				</div>
				<div class="mb-3">
				  <label for="phone">Phone</label>
				  <input type="text" name="checkout[phone]" value="<?php echo $phone;?>" class="form-control" id="phone" placeholder="* Phone Number:" required>
				  <div class="invalid-feedback">
					Please enter your Phone Number.
				  </div>
				</div>
				<div class="mb-3">
				  <label for="address2">Address</label>
				  <textarea style="border: 1px solid #dddddd;" name="checkout[address]" class="form-control" placeholder="* Delivery Address : "></textarea>
				</div>
				<div class="row">
				  <div class="col-md-4 mb-3">
					<label for="Zone">Zone No.</label>
					<input type="text" name="checkout[zone]" class="form-control" id="zoneno" placeholder="* Zone No. : " value="">
				  </div>
				  <div class="col-md-4 mb-3">
				  <label for="street">Street No.</label>
				  <input type="text" name="checkout[street]" class="form-control" id="streetno" placeholder="* Street No. :" value="">
				  </div>
				  <div class="col-md-4 mb-3">
				  <label for="building">Building No.</label>
				  <input type="building" name="checkout[building]" class="form-control" id="building" placeholder="* Building No. :" value="">
				  </div>
				</div>
				<hr class="mb-4">
				<h4 class="mb-3">Payment</h4>

				<div class="d-block my-3">
				  <div class="custom-control custom-radio">
					<input id="cod" name="paymentMethod" type="radio" class="custom-control-input" checked required>
					<label class="custom-control-label" for="credit">Cash On Delivery</label>
				  </div>
				</div>
				<hr class="mb-4">
				<input type="hidden" value="<?php echo $this->cart->total();?>" name="checkout[total_price]" />
                <input type="submit" name="submit" class="genric-btn primary" value="Checkout"/>
			  </form>
			</div>
		</div>
	</div>
</section>