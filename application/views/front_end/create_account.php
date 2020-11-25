<?php
?>
<div id="create_account" class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6">
				<div id="reservations">
					<h2>Create Account</h2>
					<form id="create_form" class="pad_top13" action="Frontend/register_action" method="post">
						<div class="mb-3">
							<label for="name">Name:</label>
							<input type="text" name="register[name]"  autocomplete="off" class="form-control" placeholder="* Name : " onFocus="this.placeholder = ''" onBlur="this.placeholder = '* Name :'" required />
						</div>
						<div class="mb-3">
							<label for="email">Email Address:</label>
							<input type="email" name="register[email]"  autocomplete="off" class="form-control" placeholder="* Email : " onFocus="this.placeholder = ''" onBlur="this.placeholder = '* Email :'" required />
						</div>
						<div class="mb-3">
							<label for="password">Password:</label>
							<input type="password" name="register[password]"  autocomplete="off" class="form-control" placeholder="* Password : " onFocus="this.placeholder = ''" onBlur="this.placeholder = '* Password :'" required />
						</div>	
						<div class="mb-3">
							<label for="phone">Contact Number:</label>
							<input type="text" name="register[phone]"  autocomplete="off" class="form-control" placeholder="* Contact No : " onFocus="this.placeholder = ''" onBlur="this.placeholder = '* Contact No :'" required />
						</div>	
						<input id="reservesubmitBtn" value="Create Account" name="Confirm" type="submit" class="genric-btn primary"/>
					</form>
				</div>
			</div> 
			<div class="col-md-6">
				<div id="reservations">
					<h2>Login</h2>
					<form id="login_forms" class="pad_top13" action="Frontend/login_action" method="POST">
						<div class="mb-3">
							<label for="email">Email Address:</label>
							<input type="email" name="email"  autocomplete="off" class="form-control" placeholder="* Email : " onFocus="this.placeholder = ''" onBlur="this.placeholder = '* Email :'" required />
						</div>
						<div class="mb-3">
							<label for="password">Password:</label>
							<input type="password" name="password" class="form-control" placeholder="* Password : " onfocus="this.placeholder = ''" autocomplete="off" onBlur="this.placeholder = '* Password :'" required />
						</div>		
						<input id="reservesubmitBtn" value="Login" name="Confirm" type="submit" class="genric-btn primary"/>
					</form>
				</div>
			</div> 
		</div>
	</div>                          
</div>