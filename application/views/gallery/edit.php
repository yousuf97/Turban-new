<?php
$edt='';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Gallery</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Gallery</li>
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
            <h3 class="box-title">Edit Image</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label>Image Preview: </label>
                  <img src="<?php echo base_url() . $gallery_data['file_name'] ?>" width="300" height="200" class="img-circle"/>
                </div>

                <div class="form-group">

                  <label for="gallery_image">Upload Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="gallery_image" name="image" type="file"/>
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" autocomplete="off" value="<?php echo ($this->input->post('title'))?$edt:$gallery_data['title'] ?>" />
                </div>
                
                <div class="form-group">
                  <label for="store">Active</label>
                  <select class="form-control" id="status" name="status"> 
                    <option value="1" <?php if($gallery_data['status'] == 1) { echo 'selected="selected"'; } ?>>Yes</option>
                    <option value="2" <?php if($gallery_data['status'] == 2) { echo 'selected="selected"'; } ?>>No</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('gallery/') ?>" class="btn btn-warning">Back</a>
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
    $("#gallery_image").fileinput({
        overwriteInitial: true,
        resizeImage: true,
        maxImageWidth: 1000,
        maxImageHeight: 667,
        resizePreference: 'width',
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