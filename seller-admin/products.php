<?php
	session_start();	
	require "../includes/connect.php";
	require "includes/sessions.php";
	$headtitle = "";
?>
<?php include "includes/head.php";?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $sdpg =4;?>
  <?php include "includes/sidebar.php";?>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $logo_row["name"];?></a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	<?php 
		if (isset($_SESSION["error"])){ 
			echo '<script type="text/javascript">toastr.error("'.$_SESSION["error"].'")</script>';
			unset($_SESSION["error"]);
		} if (isset($_SESSION["success"])){ 
			echo '<script type="text/javascript">toastr.success("'.$_SESSION["success"].'")</script>';
			unset($_SESSION["success"]);
		} if (isset($_SESSION["info"])){ 
			echo '<script type="text/javascript">toastr.info("'.$_SESSION["info"].'")</script>';
			unset($_SESSION["info"]);
		} if (isset($_SESSION["warning"])){ 
			echo '<script type="text/javascript">toastr.warning("'.$_SESSION["warning"].'")</script>';
			unset($_SESSION["warning"]);
		}
	?>
	
	    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
				<div class="row">
			     <div class="col-6">
                  <form >
		          <select class="form-group form-control-sm input-sm" id="select_category">
		
                      <?php if(isset($_GET['category'])){?>
					  <option value = '' >
					  <?php
						  $cate = $_GET["category"];
						  $caqry = "SELECT * FROM category where category_id = '$cate'";
						   $cares = $pdo->query($caqry);
						   $carow = $cares->fetch_assoc();
						   echo $carow["category"];
					  }else{
						   echo ' ';
					  }?> </option>
					  <option value = "0" > All Categories</option>
                      <?php
					    $sstmt = "SELECT * FROM products WHERE shop_id = '$shop_id' GROUP BY category_id";
						$sres = $pdo->query($sstmt);
						if($sres->num_rows > 0){
							while($srow=$sres->fetch_assoc()){
								$scatid = $srow["category_id"];
								$cstmt = "SELECT * FROM category WHERE category_id = '$scatid'";
								$cres = $pdo->query($cstmt);

								while($crow=$cres->fetch_assoc()){
								  $selected = ($crow['category_id'] == $catid) ? 'selected' : ''; 
								  echo "
									<option value='".$crow['category_id']."' ".$selected.">".$crow['category']."</option>
								  ";
                        }}}
                      ?>
                    </select>
		</form>
                </div>
				<div class="col-6 float-right">
					<a href="add_product.php" class="btn btn-warning float-right"><i class="fa fa-plus"></i> New</a>
				</div>
              </div>
             </div>
              <!-- /.card-header -->
              <div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
				  <?php
			  $where = '';
			  if(isset($_GET['category'])){
				$catid = $_GET['category'];
				$where = 'category_id ='.$catid;
		   	    $stmt = "SELECT * FROM products WHERE shop_id = '$shop_id' AND $where ";
			    }else{
			    $stmt = "SELECT * FROM products WHERE shop_id = '$shop_id' ";
                }
		     $p_res = $pdo->query($stmt);
			 if($p_res->num_rows < 1){ ?>
				 <div style="padding-top:30px" align="center">
				 <span style='font-size:100px;'>&#128542;</span>
				 <p>No Products Available</p>
				 </div>
			 <?php } else {
				 while($prow = $p_res->fetch_assoc()){ 
				 if($prow["status"] == 0){
					 $status = '<span class="badge badge-success">Active</span>';
				}elseif($prow["status"] == 1){
					 $status = '<span class="badge badge-danger">Inactive</span>';
				}elseif($prow["status"] == 2){
					 $status = '<span class="badge badge-danger">Blacklisted</span>';
				}elseif($prow["status"] == 3){
					 $status = '<span class="badge badge-warning">Reported</span>';
				}
				 ?>
                  <tr>
                    <td><?php echo $prow["name"];?></td>
                    <td><button type="button" class="btn btn-xs btn-primary view_desc" id="<?php echo $prow["product_id"];?>" data-toggle="modal" data-target="#modal-desc"><i class="fa fa-search"></i> View</button></td>
                    <td>Ksh. <?php echo $prow["price"];?></td> 
                    <td><?php echo $prow["quantity"];?></td> 
                    <td><?php echo $status;?></td>
                    <td>
					<button type="button" class="btn btn-xs btn-primary view_prod" id="<?php echo $prow["product_id"];?>" data-toggle="modal" data-target="#modal-view"><i class="fa fa-search"></i> Details</button>
					<button type="button" class="btn btn-xs btn-info edit_prod" id="<?php echo $prow["product_id"];?>" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pencil-alt"></i> Edit</button>
					<a href="product_more.php" ></a>
					<a href="../processes/productprocesses.php?delete=<?php echo $prow["product_id"];?>" onClick="return confirm('Are you sure you want to delete?');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
					</td>
                  </tr>
			 <?php }} ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
	
    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
    <?php include "includes/footer.php";?>
  <!-- ./Main Footer -->
</div>
<!-- ./wrapper -->

 <!-- MODALS -->

      <div class="modal fade" id="modal-desc">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Product Description</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<small class="text-primary">* You can make changes to the description below, then save changes</small>
				<form action="../processes/productprocesses.php" method="POST" >
				<div class="form-group">
				<textarea id="desc-textarea" class="form-control" name="desc" style="height: 300px" >
					<span id="description"></span>
				</textarea>
					<span id="idd"></span>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Save changes" name="desc-edit" class="btn btn-warning">
			  </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

	  
	  <div class="modal fade" id="modal-view">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Product Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="details">
				
				
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

		<div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Product </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			
             <form method="POST" action="../processes/productprocesses.php">
            <div class="modal-body" id="edit_details">
				
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Save changes" name="prod-edit" class="btn btn-warning">
			  </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
		
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": true,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.desc', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $('#select_category').change(function(){
    var val = $(this).val();
    if(val == 0){
      window.location = 'products.php';
    }
    else{
      window.location = 'products.php?category='+val;
    }
  });

  $('#addproduct').click(function(e){
    e.preventDefault();
    getCategory();
  });

  $("#addnew").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

  $("#edit").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'products_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#desc').html(response.description);
      $('.name').html(response.prodname);
      $('.prodid').val(response.prodid);
      $('#edit_name').val(response.prodname);
      $('#catselected').val(response.category_id).html(response.catname);
      $('#edit_price').val(response.price);
      CKEDITOR.instances["editor2"].setData(response.description);
      getCategory();
    }
  });
}
function getCategory(){
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    success:function(response){
      $('#category').append(response);
      $('#edit_category').append(response);
    }
  });
}
</script>
<script>  
 $(document).ready(function(){  
      $('.view_desc').click(function(){  
           var product_id = $(this).attr("id");  
		   document.getElementById("idd").innerHTML = '<input type="hidden" name="prodid" value="'+product_id+'" >';
           $.ajax({  
                url:"product_row.php",  
                method:"POST",  
                data:{viewdesc_id:product_id},  
                success:function(data){  
                     $('#description').html(data);   
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('.view_prod').click(function(){  
           var product_id = $(this).attr("id");  
           $.ajax({  
                url:"product_row.php",  
                method:"POST",  
                data:{proddet_id:product_id},  
                success:function(data){  
                     $('#details').html(data);   
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('.edit_prod').click(function(){  
           var product_id = $(this).attr("id");
           $.ajax({  
                url:"product_row.php",  
                method:"POST",  
                data:{editprod_id:product_id},  
                success:function(data){  
                     $('#edit_details').html(data);   
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 });  
 </script>
 <script>
  $(function () {
    // Summernote
    $('#desc-textarea').summernote(
	{
  toolbar: [
  ['style', ['style']],
  ['style', ['bold', 'italic', 'underline']],
  ['font', ['superscript', 'subscript']],
  ['fontsize', ['fontsize']],
  ['fontname', ['fontname']],
  ['color', ['color']],
  ['para', ['ul', 'ol', 'paragraph']],
  ['table', ['table']],
  ['view', ['fullscreen', 'help']],
],

})
  })
</script>
<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Link Copied");
}
</script>
</body>
</html>