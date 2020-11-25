<?php $model=new Model_getrows(); ?>
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb_iner text-center">
					<div class="breadcrumb_iner_item">
						<h2>Our Blog</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- breadcrumb start-->

<!--================Blog Area =================-->
<section class="blog_area section_padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 mb-5 mb-lg-0">
				<div class="blog_left_sidebar">
				<?php
					$blogs=$model->get_blogs();				
					foreach($blogs as $blog) {
				?>
					<article class="blog_item">
						<div class="blog_item_img">
							<img class="card-img rounded-0" src="<?php echo $blog->blog_image; ?>" alt="<?php echo $blog->blog_title; ?>">
							<a href="#" class="blog_item_date">
								<h3><?php echo date("d", strtotime($blog->created_on)); ?></h3>
								<p><?php echo date("M", strtotime($blog->created_on)); ?></p>
							</a>
						</div>

						<div class="blog_details">
							<a class="d-inline-block" href="#">
								<h2><?php echo $blog->blog_title; ?></h2>
							</a>
							<p><?php echo $blog->blog_description; ?></p>							
						</div>
					</article>
				<?php }  ?> 
				</div>
			</div>
		</div>
	</div>
</section>
<!--================Blog Area =================-->