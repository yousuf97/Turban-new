<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Todays Special</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Todays Special</li>
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
            <h3 class="box-title">Add Special Items</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="add_specials" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="store">Category</label>
                      <select class="form-control" id="cate" onchange="get_menus(this.value)" name="category">
                        <option value="0">--Select Category--</option>
                        <?php
                        foreach($category as $cat)
                        {
                        ?>
                        <option value="<?php echo $cat['id'];?>"><?php echo $cat['name'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="title">Date</label>
                      <input type="text" class="form-control" id="date" name="s_date"value="<?php echo date('Y-m-d');?>" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="store">Menu</label>
                      <select class="form-control" id="menu" name="menu">
                        
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="store">Active</label>
                      <select class="form-control" id="status" name="status">
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                      </select>
                    </div>
                </div>
                
                

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('Special/') ?>" class="btn btn-warning">Back</a>
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
   //$(".datepicker").datepicker();
    $("#bannerMainNav").addClass('active');
    $("#createBannersubMenu").addClass('active');
    
  });
  function get_menus(cate)
  {
    $.ajax({
        type:'POST',
        url:'get_menus',
        data:'category='+cate,
        success:function(data)
        {
            $("#menu").html(data);
        }
    });
  }
 
</script>