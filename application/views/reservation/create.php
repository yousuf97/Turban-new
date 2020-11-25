<?php
$tab_available=$this->model_reservation->get_available_tables();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Table Reservation</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Table Reservation</li>
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
            <h3 class="box-title">Add Table Reservation</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="POST" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                
                <div class="form-group">
                  <label for="customer_name">Customer name</label>
                  <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer name" autocomplete="off" value="<?php echo $this->input->post('customer_name') ?>" />
                </div>

                <div class="form-group">
                  <label for="customer_phone">Phone#</label>
                  <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Contact No." autocomplete="off" value="<?php echo $this->input->post('customer_phone') ?>"/>
                </div>

                <div class="form-group">
                  <label for="capacity">No. of Persons</label>
                  <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Enter no.of Persons" autocomplete="off" value="<?php echo $this->input->post('capacity') ?>"/>
                </div>

                <div class="form-group">
                  <label for="reserv_date">Reserved Date</label>
                  <input type="text" class="form-control datepicker" id="reserv_date" name="reserv_date" placeholder="Enter Reserved Date" autocomplete="off" value="<?php echo $this->input->post('reserv_date') ?>"/>
                </div>
                
                <div class="form-group">
                  <label for="reserv_time">Reserved Time</label>
                  <input type="text" class="form-control timepicker" id="reserv_time" name="reserv_time" placeholder="Enter Reserved Time" autocomplete="off" value="<?php echo $this->input->post('reserv_time') ?>"/>
                </div>
                
                <div class="form-group">
                  <label for="store">Set Table</label>
                  <select class="form-control" id="table_no" name="table_no">
                    <option value="0">--Select Table--</option>
                    <?php
                      foreach($tab_available as $key=>$value)
                      {
                        ?>
                        <option value="<?php echo $value['id']; ?>"><?php echo $value['table_name'].' - '.$value['capacity'].' Nos';?></option>
                        <?php
                      }
                      ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="store">Active</label>
                  <select class="form-control" id="active" name="active">
                    <option value="1">Pending</option>
                    <option value="2">Reserved</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('Reservation/') ?>" class="btn btn-warning">Back</a>
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
    $(".datepicker").datepicker();
    $('.timepicker').timepicker();

    $("#reservationMainNav").addClass('active');
    $("#createReservationSubMenu").addClass('active');
    

  });
</script>