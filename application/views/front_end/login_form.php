<div id="login_form" class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6">
				<div id="reservations" style="
    padding-top: 60px;
    padding-bottom: 10px;
">
					<h2>Login</h2>
					<form id="login_forms" class="pad_top13" action="Frontend/login_action" method="POST">
						<div class="mb-3">
							<label for="email">Email Address:</label>
							<input type="email" name="email"  autocomplete="off" class="form-control" placeholder="* Email : " onFocus="this.placeholder = ''" onBlur="this.placeholder = '* Email :'" required />
						</div>
						<div class="mb-3">
							<label for="password">Password:</label>
							<input type="password" name="password" class="form-control" placeholder="* Password : " onfocus="this.placeholder = ''" autocomplete="off" onBlur="this.placeholder = '* Password :'" required />
						<br>
						</div>		
						<input id="reservesubmitBtn" value="Login" name="Confirm" type="submit" class="genric-btn primary"/>
					</form>
				</div>
			</div> 
			<br>
			<div class="col-md-6" style="padding-bottom: 60px;padding-top: 60px;">
				<h2>Don't Have an Account?</h2>
				<div class="pad_top13">					
					<a href="register" class="genric-btn primary">Create an account</a>
				</div>				
			</div>
		</div>
	</div>
</div>
</div>
