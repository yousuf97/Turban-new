<?php $model=new Model_getrows(); ?>
<!--::chefs_part start::-->
<section class="chefs_part blog_item_section section_padding">
	<div class="container">
		<div class="row">
			<div class="col-xl-5">
				<div class="section_tittle">
					<p>Team Member</p>
					<h2>Our Experience Chefs</h2>
				</div>
			</div>
		</div>
		<div class="row">
		<?php
			$chefs=$model->get_chefs();				
			foreach($chefs as $chef) {
		?>
			<div class="col-sm-6 col-lg-4">
				<div class="single_blog_item">
					<div class="single_blog_img">
						<img src="<?php echo $chef->chef_img; ?>" alt="<?php echo $chef->chef_name; ?>">
					</div>
					<div class="single_blog_text text-center">
						<h3><?php echo $chef->chef_name; ?></h3>
						<p><?php echo $chef->designation; ?></p>
						<div class="social_icon">
							<a href="<?php echo $chef->fb_link; ?>"> <i class="ti-facebook"></i> </a>
							<a href="<?php echo $chef->insta_link; ?>"> <i class="ti-instagram"></i> </a>
						</div>
					</div>
				</div>
			</div>
		<?php  }  ?>
		</div>
	</div>
</section>
<!--::chefs_part end::-->

