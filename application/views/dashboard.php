<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Nizami Cafeteria</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
  <!-- Main content -->
    <section class="content">
    <?php if($is_admin == true): ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-maroon">
              <div class="inner">
              <?php 
$menu=$this->model_orders->get_all_count('products');
$online=$this->model_orders->get_all_count('checkout');
$take=$this->model_orders->get_all_count('take_away_orders');
$dine=$this->model_orders->get_all_count('orders');

              ?>
                <h3><?php echo $menu;?></h3>
                <p>All Menus</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-restaurant"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-navy">
              <div class="inner">
                <h3><?php echo $dine;?></h3>
                <p>Dine In Orders</p>
              </div>
              <div class="icon">
                <i class="fa fa-coffee"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-teal">
              <div class="inner">
                <h3><?php echo $take;?></h3>
                <p>TakeAway Orders</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-bag"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $online;?></h3>
                <p>Online Orders</p>
              </div>
              <div class="icon">
                <i class="fa fa-motorcycle"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Order Chart</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <canvas id="barChart" style="height: 229px; width: 563px;" height="286" width="703"></canvas>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <a href="reservation">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-table"></i></span>
<?php 
$dinein=$this->model_orders->order_not_confirmed('orders','paid_status');
$reser=$this->model_orders->order_not_confirmed('order_table','status');
$tak=$this->model_orders->order_not_confirmed('take_away_orders','paid_status');
$onl=$this->model_orders->order_not_confirmed('checkout','status');
?>
                    <div class="info-box-content">
                      <span class="info-box-text">Table Reservation</span>
                      <span class="pull-right-container">
                      <?php
                      if($reser)
                      {
                        ?>
                        <small class="label bg-red">New Order</small>
                        <?php
                      }
                      else{
                        
                      }
                      ?>
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                <!-- /.info-box -->
                </a>
              </div>
              <div class="col-md-6">
              <a href="orders">
                <div class="info-box">
                  <span class="info-box-icon bg-purple"><i class="fa fa-cutlery"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Dine In</span>
                    <span class="pull-right-container">
                    <?php
                      if($dinein)
                      {
                        ?>
                        <small class="label bg-red">New Order</small>
                        <?php
                      }
                      else{
                        
                      }
                      ?>
                      </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </a>
              </div>
              <div class="col-md-6">
                <a href="orders/online">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-shopping-cart"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Online Orders</span>
                    <span class="pull-right-container">
                      <?php
                      if($onl)
                      {
                        ?>
                        <small class="label bg-red">New Order</small>
                        <?php
                      }
                      else{
                        
                      }
                      ?>                        
                      </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
              <div class="col-md-6">
              <a href="TakeAwayOrders">
                <div class="info-box">
                  <span class="info-box-icon bg-fuchsia"><i class="fa fa-envelope"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Take Away Order</span>
                    <span class="pull-right-container">
                    <?php
                      if($tak)
                      {
                        ?>
                        <small class="label bg-red">New Order</small>
                        <?php
                      }
                      else{
                        
                      }
                      ?>
                      </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </a>
              </div>
              <div class="col-md-6">
              <a href="#">
                <div class="info-box">
                  <span class="info-box-icon bg-teal disabled"><i class="fa fa-motorcycle"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Delivery Details</span>
                    <span class="pull-right-container">
                        <small class="label bg-red"></small>
                      </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </a>
              </div>
              <div class="col-md-6">
              <a href="reports/customer">
                <div class="info-box">
                  <span class="info-box-icon bg-light-blue"><i class="fa fa-envelope"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Customers</span>
                    <span class="pull-right-container">
                        <small class="label bg-success text-black">View</small>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </a>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="box box-warning">
              <div class="box-header with-border">
                <h3 class="box-title">Latest Orders</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Customer Name</th>
                      <th>Order Type</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
$online=$this->model_orders->get_confirmd_notpaid_order('checkout','status');
foreach($online as $onl)
{

?>
                   
                    <tr>
                        <td><a href="orders/online"><?php echo $onl['bill_no'];?></a></td>
                        <td><?php echo $onl['name'];?></td>
                        <td>Online</td>
                        <td><span class="label label-danger">Not Confirmed</span></td>
                        
                      </tr>
                    
<?php
}
$ta=$this->model_orders->get_confirmd_notpaid_order('take_away_orders','paid_status');
foreach($ta as $take)
{

?>
                   
                   <tr>
                      <td><a href="TakeAwayOrders"><?php echo $take['bill_no'];?> </a></td>
                      <td><?php echo $take['customer_name'];?></td>
                      <td>Take Away</td>
                      <td><span class="label label-danger">Not Confirmed</span></td>
                      
                    </tr>
                   
<?php
}
                      ?>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->
              
              <!-- /.box-footer -->
            </div>
          </div>
        </div>

      </div>
    <?php endif;?>
    </section>
</div>