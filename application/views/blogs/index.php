<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1> Manage <small>Blogs</small> </h1>
	  <ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Blogs</li>
	  </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div id="messages"></div>
				<?php if(in_array('createBlogs', $user_permission)): ?>
					<a class="btn btn-primary" href="<?php echo base_url('blogs/create');?>" >Add Blog</a>
					<br /> <br />
				<?php endif; ?>
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Manage Blogs</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="manageTable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Blog Title</th>
									<th>Image</th>
									<?php if(in_array('updateChefs', $user_permission) || in_array('deleteChefs', $user_permission)): ?>
									<th>Action</th>
									<?php endif; ?>
								</tr>
							</thead>
							<tbody>

							</tbody>
					  </table>
					</div>
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

<?php if(in_array('deleteBlogs', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Blogs</h4>
      </div>

      <form role="form" action="<?php echo base_url('blogs/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Remove</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>
<script>
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#blogsMainNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'Blogs/fetchBlogsData',
    'order': []
  });

});
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { product_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}


</script>
</script>