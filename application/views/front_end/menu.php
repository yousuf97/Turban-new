<!-- breadcrumb-area-start -->
<div class="breadcrumb-area pt-45 pb-45" style="
    background-color: #ddd;">
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<div class="breadcrumb-text text-center">
							<h1>Menu</h1>
							<span>CHECK OUT OUR MENU</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumb-area-end -->

		<!-- special-menu-area-start -->
		<div class="special-menu-area pb-100">
			<div class="container">
				<div class="row">
					
					<div class="col-md-12">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					
					<ul class="nav special-menu-tab justify-content-center mb-50" id="myTab2" role="tablist">
					<div class="container">
				<div class="row justify-content-between">
					<div class="brand-active owl-carousel"
					class="carousel slide"data-interval="false">
					

							
						<?php 
						$num=0;
foreach($categs as $key=>$value)
{
	$where="category_id=".$value->id;
	$sub_cat=$this->Model_getrows->get_menu('*','sub_category',$where);
	foreach($sub_cat as $ky=>$val)
	{
		?>
		<li class="nav-item"> 
			<a class="nav-link active" id="prod<?php echo $num;?>" data-toggle="tab" onclick="get_products(<?php echo $num;?> )"><?php echo $val->name;?></a>
		</li>
		
	<?php	
	$num++;
	}

						  
}
?>



					</div>
					</div>	
					</div>
					<!-- <div class="owl-nav ">
					<button type="button" role="presentation" class="owl-prev">
						<span aria-label="Previous" style="
    font-size: 3em;
    padding: 5px;
    position: absolute;
    top: -14px;
    left: -44px;
">‹</span>
</button>
<button type="button" role="presentation" class="owl-next">
	<span aria-label="Next" style="
    font-size: 3em;
    padding: 5px;
    position: absolute;
    top: -14px;
    right: 0;
">›</span>
</button>
</div> -->
						</ul>
						
						<div class="tab-content" id="myTabContent2">
							<div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home1-tab">
								<div class="row">
								<div class="col-xl-12">
								<div class="col-xl-6">
								<div class="special-menu-wrapper mb-30">
											<div class="single-special">
												<div class="special-menu-img">
													<img src="assets/front/img/special-menu/1.png" alt="" />
												</div>
												<div class="special-menu-text">
													<div class="special-right">
														<span>$11.95</span>
													</div>
													<h4>Special Wonthan</h4>
													<p>Blackened Chicken, Cherry Tomatoes, Green Pepper, Onion, Marinara, Mozzarella & Parmesan</p>
												</div>
											</div>
											
										</div>
								</div>
								<div class="col-xl-6">
								<div class="special-menu-wrapper mb-30">
											<div class="single-special">
												<div class="special-menu-img">
													<img src="assets/front/img/special-menu/1.png" alt="" />
												</div>
												<div class="special-menu-text">
													<div class="special-right">
														<span>$11.95</span>
													</div>
													<h4>Special Wonthan</h4>
													<p>Blackened Chicken, Cherry Tomatoes, Green Pepper, Onion, Marinara, Mozzarella & Parmesan</p>
												</div>
											</div>
											
										</div>
								</div>
								</div>
									<div class="col-xl-12">
										<div class="special-menu-button text-center pt-40">
											<a href="#">LOAD MORE</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- special-menu-area-end -->
		<script>
	function get_products(k) 
	{
	var id=$("#prod"+k).val()
	}
</script>