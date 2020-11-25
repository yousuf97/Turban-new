<?php
 
// foreach ($category_data as $k => $v) {
//     // $result[$k]['category'] = $v;
//      $result[$k]['products'] = $this->model_products->getProductDataByCat($v['id']);
//  }
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>View Products</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">View Products</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-6 col-xs-12">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
<?php #print_r($category);
foreach ($category as $k => $v) 
{
    $products = $this->model_products->getProductDataByCat($v['id']);
    
?>
                <a data-toggle="collapse" data-parent="#accordion" href="#cat<?php echo $k; ?>">
					<div class="panel-heading bg-success" style="border-bottom:1px solid #dddddd;">
					    <h4 class="panel-title">
              <?php echo $v['name'];?>&nbsp;
              <i class="badge badge-notify bg-aqua"><?php echo count($products);?></i>
              <span class="fa fa-chevron-circle-right pull-right"></span>
						</h4>
					</div>
				</a>
			    <div id="cat<?php echo $k; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                        <?php
                        foreach ($products as $key => $val): 
                        ?>
                       
                            <li><?php echo $val['name'];?></li>
                        
                        <?php
                        endforeach;
                        ?>
                        </ul>
                    </div>
			    </div>
<?php
    
}
?>
				
			</div>
        </div>
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->