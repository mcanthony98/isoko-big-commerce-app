<?php include "includes/header.php";?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

   <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-lg navbar-light navbar-white">
    <div class="container-fluid">
      
	  <a href="index.php" class="navbar-brand">
        <img src="img/isoko4.jpg" alt="isoko Logo" class="brand-image" >
      </a>
	  
             
      <!-- Right navbar links -->
      <ul class="order-1 order-lg-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item text-center">
          <span class="nav-link">
            <i class="fas fa-lock text-success"></i> <span>Secure Checkout</span>
          </span>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light" style="min-height: 568px;">
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
	  <div class="row">
	  <div class="col-sm-2">
	  </div>
	  <div class="col-sm-8">
      <div class="card card-solid mt-2">
        <div class="card-header">
			Order Summary
			<a class="btn btn-sm bg-white float-right" href="cart.php"><span class="text-bold text-orange fa fa-shopping-cart"> Modify Cart</span></a>
		</div>
        <div class="card-body">
				<div class="row">
					<div class="col-sm-6 ">
					  <div class="d-flex">
						<div class="image">
							<span class="text-orange text-bold">3&times </span>
						</div>
						<div class="d-block ml-2">
							<a href="product.php" class="text-muted">Britania chocolate mixed with fish beef tins</a><br/>
							<span class="text-orange ">Subtotal: Ksh 3,400</span>
							
						</div>
					  </div>
					  <hr>
					  <div class="d-flex">
						<div class="image">
							<span class="text-orange text-bold">3&times </span>
						</div>
						<div class="d-block ml-2">
							<a href="product.php" class="text-muted">Britania chocolate mixed with fish beef tins</a><br/>
							<span class="text-orange ">Subtotal: Ksh 3,400</span>
							
						</div>
					  </div>
					  <hr>
					</div>
					<div class="col-sm-1 d-none d-sm-block border-right">
					</div>
					<div class="col-sm-5">
						<div class="text-left text-muted text-sm">
							<p>
								Delivery To:<br/><!--or Pick Up at-->
								Mark Anthony Maina<br/>
								PoshMart, KEMU, North Imenti, Meru<br/>
								+254 715694859 <br/>
								<span class="text-bold">Delivery Cost: Ksh 300</span> <br/>
							</p>
							<p><u>Seller: Llana House Cart Limited Kenya</u></p>
						</div>
					</div>
				</div>
				<hr >
				<hr >
				
				
				<div class="row">
					<div class="col-sm-6 ">
					  <div class="d-flex">
						<div class="image">
							<span class="text-orange text-bold">3&times </span>
						</div>
						<div class="d-block ml-2">
							<a href="product.php" class="text-muted">Britania chocolate mixed with fish beef tins</a><br/>
							<span class="text-orange ">Subtotal: Ksh 3,400</span>
							
						</div>
					  </div>
					  <hr>
					</div>
					<div class="col-sm-1 d-none d-sm-block border-right">
					</div>
					<div class="col-sm-5">
						<div class="text-left text-muted text-sm">
							<p>
								Pick Up :<br/><!--or Pick Up at-->
								Mark Anthony Maina<br/>
								PoshMart, KEMU, North Imenti, Meru<br/>
								+254 715694859 <br/>
								<span class="text-bold">Cost: Ksh 0</span> <br/>
							</p>
							<p><u>Seller: Llana House Cart Limited Kenya</u></p>
						</div>
					</div>
				</div>
				<hr >
				
				
				</div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
	  
	  <!-- Coupon Code -->
	  <form class="card p-2">
			<small>Enter Coupon code if any.</small>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code" required>
              <div class="input-group-append">
                <button type="submit" class="btn bg-orange"><span class="text-white text-bold">Redeem</span></button>
              </div>
            </div>
          </form>
		  
		  
	  <!-- Order total box -->
			  <div class="card card-solid container">
				  <div class="card-body container">
					<span class="justify-content-between d-flex "><span>Items total</span><span>Ksh 6,700</span></span>
					<span class="justify-content-between d-flex "><span>Delivery Cost</span><span>Ksh 700</span></span>
					<span class="justify-content-between d-flex "><span>VAT</span><span>Ksh 12</span></span><hr>
					<span class="justify-content-between d-flex text-bold"><span class="text-bold">Total</span><span>Ksh 12,000</span></span><hr>
				  </div>
			  </div>
			  <!-- /.card -->
			  
			  
			  <!-- Order total box -->
			<div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Payment</h3>
            </div>
            <div class="card-body">
			
			 <div>
				<img src="img/mpesa.jpg" style="width:110px;height:70px">
			 </div>
              <div class="form-group">
                <label for="inputEstimatedBudget">Pay Via M-Pesa</label>
                <input type="text" name="phone" id="inputEstimatedBudget" placeholder="Enter M-Pesa Number " class="form-control" required data-inputmask='"mask": "+254 999 999 999"' data-mask>
              </div>
			  
			  <p>
				<h5><i class="fa fa-exclamation"></i> <b>Note</b></h5>
				Dear Customer,<br/>
				You will receive an M-PESA prompt on your phone shortly requesting you to enter your M-PESA PIN to complete this transaction. Please ensure your phone is ON and UNLOCKED to enable you to complete the process.
				Thank you.
              </p>
            </div>
            <!-- /.card-body -->
			  <div class="card-footer">
				<a class="btn btn-block bg-orange" href="checkout.php"><span class="text-bold text-white">PAY KSH 12,000</span></a>
			  </div>
          </div>
          <!-- /.card -->  
	  </div>
	  </div>
			  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include "includes/scripts.php";?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
</body>
</html>