<?php
$edt='';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	<h1>
	  Manage
	  <small>Chefs</small>
	</h1>
	<ol class="breadcrumb">
	  <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">Chefs</li>
	</ol>
	</section>
	<!-- Main content -->
	<section class="content">
	<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div id="messages"></div>
				<?php if($this->session->flashdata('success')): ?>
				  <div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $this->session->flashdata('success'); ?>
				  </div>
				<?php elseif($this->session->flashdata('error')): ?>
				  <div class="alert alert-error alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $this->session->flashdata('error'); ?>
				  </div>
				<?php endif; ?>
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Edit Chef</h3>
					</div>
					<!-- /.box-header -->
					<form role="form" action="" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<?php echo validation_errors(); ?>
							<div class="form-group">
								<label>Image Preview: </label>
								<img src="<?php echo base_url() . $chef_data['chef_img'] ?>" width="300" height="200" class="img-circle"/>
							</div>
							<div class="form-group">
								<label for="chef_image">Image</label>
								<div class="kv-avatar">
									<div class="file-loading">
										<input id="chef_image" name="image" type="file"/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="chef_name">Chef's Name</label>
								<input type="text" class="form-control" id="chef_name" name="chef_name" placeholder="Enter Chef's Name" autocomplete="off" value="<?php echo ($this->input->post('chef_name'))?$edt:$chef_data['chef_name'] ?>" />
							</div>
							<div class="form-group">
								<label for="chef_designation">Chef's Designation</label>
								<input type="text" class="form-control" id="chef_designation" name="chef_designation" placeholder="Enter Chef's Designation" autocomplete="off" value="<?php echo ($this->input->post('designation')) ?$edt:$chef_data['designation'] ?>"/>
							</div>
							<div class="form-group">
								<label for="fb_link">Facebook Link</label>
								<input type="text" class="form-control" id="fb_link" name="fb_link" placeholder="Enter Facebook Link" autocomplete="off" value="<?php echo ($this->input->post('fb_link')) ?$edt:$chef_data['fb_link'] ?>"/>
							</div>
							<div class="form-group">
								<label for="category">Instagram Link</label>
								<input type="text" class="form-control" id="insta_link" name="insta_link" placeholder="Enter Instagram Link" autocomplete="off" value="<?php echo ($this->input->post('insta_link')) ?$edt:$chef_data['insta_link'] ?>"/>
							</div>
							<div class="form-group">
								<label for="store">Active</label>
								<select class="form-control" id="active" name="active"> 
									<option value="1" <?php if($chef_data['active'] == 1) { echo 'selected="selected"'; } ?>>Yes</option>
									<option value="2" <?php if($chef_data['active'] == 2) { echo 'selected="selected"'; } ?>>No</option>
								</select>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<a href="<?php echo base_url('chefs/') ?>" class="btn btn-warning">Back</a>
						</div>
					</form>
					<!-- /.box-body -->
				</div>
			<!-- /.box -->
			</div>
		  <!-- col-md-12 -->
		</div>
		<!-- /.row -->
	</section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {

    $("#chefsMainNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#chef_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>