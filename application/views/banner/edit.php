<?php
$edt='';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Banners</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Banner</li>
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
            <h3 class="box-title">Add Banner</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label>Image Preview: </label>
                  <img src="<?php echo base_url() . $banner_data['image'] ?>" width="300" height="200" class="img-circle"/>
                </div>

                <div class="form-group">

                  <label for="banner_image">Image (1920X899)</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="banner_image" name="image" type="file"/>
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="banner_name">Banner name</label>
                  <input type="text" class="form-control" id="banner_name" name="banner_name" placeholder="Enter banner name" autocomplete="off" value="<?php echo ($this->input->post('banner_name'))?$edt:$banner_data['banner_name'] ?>" />
                </div>

                <div class="form-group">
                  <label for="sort_order">Sort Order</label>
                  <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder="Enter sort order" autocomplete="off" value="<?php echo ($this->input->post('sort_order')) ?$edt:$banner_data['sort_order'] ?>"/>
                </div>

                <div class="form-group">
                  <label for="head">Head</label>
                  <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder="Enter sort order" autocomplete="off" value="<?php echo ($this->input->post('sort_order')) ?$edt:$banner_data['sort_order'] ?>"/>
                </div>

                <div class="form-group">
                  <label for="category">Link</label>
                  <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder="Enter sort order" autocomplete="off" value="<?php echo ($this->input->post('sort_order')) ?$edt:$banner_data['sort_order'] ?>"/>
                </div>

                <div class="form-group">
                  <label for="store">Active</label>
                  <select class="form-control" id="active" name="active"> 
                    <option value="1" <?php if($banner_data['active'] == 1) { echo 'selected="selected"'; } ?>>Yes</option>
                    <option value="2" <?php if($banner_data['active'] == 2) { echo 'selected="selected"'; } ?>>No</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('banner/') ?>" class="btn btn-warning">Back</a>
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

    $("#bannerMainNav").addClass('active');
    $("#createBannerSubMenu").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#banner_image").fileinput({
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