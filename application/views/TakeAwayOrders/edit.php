<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Take Away Orders</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders</li>
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
            <h3 class="box-title">Edit Order</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('TakeAwayOrders/update') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="date" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="time" class="col-sm-12 control-label">Date: <?php echo date('h:i a') ?></label>
                </div>
				<div class="col-md-12">
					<div class="form-group col-md-6">
						<label for="customer_name" class="col-sm-5 control-label">Customer Name</label>
						<div class="col-sm-7">
						  <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $order_data['order']['customer_name']?>">
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="customer_number" class="col-sm-5 control-label">Customer Number</label>
						<div class="col-sm-7">
						  <input type="text" class="form-control" id="customer_number" name="customer_number" value="<?php echo $order_data['order']['customer_number']?>">
						</div>
					</div>
				</div>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:50%">Product</th>
                      <th style="width:10%">Qty</th>
                      <th style="width:10%">Price per item</th>     
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>
                   <tbody>
                    <?php
                    
                    if(isset($order_data['order_item'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($order_data['order_item'] as $key => $val): ?>
                        <?php $product_items=json_decode($val['product_id']); #print_r($product_items);
                           foreach($product_items as $ky=>$vl)
                           {
                        ?>
                            <tr id="row_<?php echo $x; ?>">
                              <td>
                                
                               <select class="form-control select_group product" data-row-id="row_<?php echo $x; ?>" id="product_<?php echo $x; ?>" name="product[]" style="width:100%;" onchange="getProductData(<?php echo $x; ?>)" required>
                                   <option value=""></option>
                                   <?php foreach ($products as $k => $v):
                                    
                                    ?>
                                     <option value="<?php echo $v['id'] ?>" <?php if($vl->product_id == $v['id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                                   <?php endforeach ?>
                                 </select>
                               </td>
                               <td><input type="number" name="qty[]" id="qty_<?php echo $x; ?>" class="form-control" required onkeyup="getTotal(<?php echo $x; ?>)" onclick="getTotal(<?php echo $x; ?>)" value="<?php echo $vl->qty; ?>" autocomplete="off"></td>
                               <td>
                                 <input type="text" name="amount[]" id="amount_<?php echo $x; ?>" class="form-control pull-left mr-1" disabled value="<?php echo $vl->price; ?>" autocomplete="off" style="width:40%;margin-right:1px;">
                                 
                                 <input type="text" name="amount_value[]" id="amount_value_<?php echo $x; ?>" class="form-control" style="width:50%;font-weight:bold;" value="<?php echo number_format($vl->subtot,2); ?>" autocomplete="off">
                               </td>
                               <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $x; ?>')"><i class="fa fa-close"></i></button></td>
                            </tr>
                        <?php $x++; 
                           }
                        ?>
                     <?php endforeach; ?>
                   <?php endif; ?>
                   </tbody>
                </table>

                <br /> <br/>
                <div class="col-md-6 col-xs-12">
                    <label>Additional Notes</label>
                    <textarea name="additional_notes" class="form-control" rows="4" style="width:100%"><?php echo $order_data['order_item'][0]['additional_notes']; ?></textarea>
                </div>
                <div class="col-md-6 col-xs-12 pull pull-right">
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Total Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled value="<?php echo $order_data['order']['amount'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" value="<?php echo $order_data['order']['amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="paid_status" class="col-sm-5 control-label">Paid Status</label>
                    <div class="col-sm-7">
                      <select type="text" class="form-control" id="paid_status" name="paid_status">
                        <option value="1">Paid</option>
                        <option value="2">Unpaid</option>
                      </select>
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">

                <a target="__blank" href="<?php echo base_url() . 'TakeAwayOrders/printDiv/'.$order_data['order']['id'] ?>" class="btn btn-default" >Print</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('TakeAwayOrders/') ?>" class="btn btn-warning">Back</a>
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
  var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#TakeAwayOrderMainNav").addClass('active');
    $("#manageTakeAwayOrderSubMenu").addClass('active');
    
    
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/TakeAwayOrders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            // console.log(reponse.x);
            var html = '<tr id="row_'+row_id+'">'+
            '<td>'+ 
            '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
            '<option value=""></option>';
            $.each(response, function(index, value) {
              if(index == "products"){
              $.each(value, function(x, y) {
              console.log(y);
              html += '<option value="'+y.id+'">'+y.name+'</option>'; 	
              });	
              }							
            });
            html += '</select>'+
                    '</td>'+ 
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';
                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();
          }
        });

      return false;
    });

  }); // /document

  function getTotal(row = null) {
    if(row) {
      var total = Number($("#amount_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(2);
      //$("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }
  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      $("#amount_"+row_id).val("");
      $("#qty_"+row_id).val("");           
      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'TakeAwayOrders/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          $("#amount_"+row_id).val(response.price);
          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);
          var total = Number(response.price) * 1;
          total = total.toFixed(2);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }
  // calculate the total amount of the order
  function subAmount() {
    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_value_"+count).val());
    } // /for
    totalSubAmount = totalSubAmount.toFixed(2);
    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);
  } // /sub total amount
  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>