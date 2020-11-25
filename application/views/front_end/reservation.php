<?php
?>
<div id="reservation" class="item">
	<img src="<?php echo $common_model->front_assets_img('8.jpg');?>"  alt="the Paxton Gipsy Hill"  class="fullBg">
	<div class="content">
		<div class="content_overlay"></div>
		<div class="content_inner" >
			<div class="row contentscroll" style="height:auto">
				<div class="container col-md-12">
					<div class="col-md-6 empty">&nbsp;</div>
					<div class="col-md-6 content_text">
						<div id="reservations">
							<h1>Reservation</h1>
							<form id="reservation_form" class="reserve_form pad_top13" action="#" method="post">
								<p>You can make a reservation by filling out the form below, Please note that reservations are only confirmed once we check availability.</p>
								<h4>Pick your Date & Time</h4>
								<div class="clearfix date_mar">
									<div class="input-group date " id="form_datetime" data-date="" data-date-format="yyyy-mm-dd HH:iip" data-link-field="dtp_input1" data-date-start-date="0d">
										<input name="dt" type="text" value="" readonly style="border-radius:0 !important;">
										<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
										<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>               
									</div>
									<input type="hidden" id="dtp_input1" value="" />
								</div>
								<h4>Reservation Details</h4>
								<div class="clearfix reserve_form"> 
									<input type="text" name="name" class="validate['required'] textbox1" placeholder="* Name : " onfocus="this.placeholder = ''" autocomplete="off" onBlur="this.placeholder = '* Name :'" />
									<input type="text" name="email"  autocomplete="off" class="validate['required','email']  textbox1" placeholder="* Email : " onFocus="this.placeholder = ''" onBlur="this.placeholder = '* Email :'" />
									<input type="text" name="phone" autocomplete="off" class="validate['required','phone']  textbox1" placeholder="* Phone : " onFocus="this.placeholder = ''" onBlur="this.placeholder = '* Phone :'" />
									<textarea name="message" class="validate['required'] messagebox1" placeholder="* Message : " onFocus="this.placeholder = ''" onBlur="this.placeholder = '* Message :'"></textarea>
									<input type="text" name="capacity" class="validate['required']  textbox1" placeholder="* No.of Persons : " autocomplete="off" onfocus="this.placeholder = ''" onBlur="this.placeholder = '* No. of Persons :'" />
									<input id="reservesubmitBtn" value="book a table" name="Confirm" type="submit" class="submitBtn"/>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>