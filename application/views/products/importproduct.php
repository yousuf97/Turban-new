

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Import Products</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Import Products</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12 text-center">
      <form method="post" id="import_csv" enctype="multipart/form-data">
			<div class="form-group">
				<label>Select CSV File</label>
				<input type="file" name="csv_file" id="csv_file" required accept=".csv" />
			</div>
			<br />
			<button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
		</form>
		<br />
		<div id="imported_csv_data"></div>
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
    $('#import_csv').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url:"<?php echo base_url(); ?>products/import",
			method:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			beforeSend:function(){
				$('#import_csv_btn').html('Importing...');
			},
			success:function(data)
			{
				$('#import_csv')[0].reset();
				$('#import_csv_btn').attr('disabled', false);
				$('#import_csv_btn').html('Import Done');
				load_data();
			}
		})
	});
  });
</script>