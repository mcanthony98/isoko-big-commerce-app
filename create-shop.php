<?php
	session_start();	
	require "includes/connect.php";
    require "includes/buyer-session.php";
	$headtitle = "I-Soko - Set up your Online Shop";
	$headdesc = "";
	$headkeywords = "";
?>
<?php include "includes/header.php";?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <?php include "includes/messages.php";?>
  <!-- /.navbar -->
<?php 
if(isset($_POST["finalsub"])){
	$_SESSION["f3mpesa"] = $_POST["mpesa"];
	
	echo '<script>window.location.href = "processes/newshop.php?create";</script>';
	exit();
}
?>
  
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light" style="min-height: 568px;">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="container"><h5 class="text-orange text-bold text-center">Setup your Shop</h5>
      <div class="row product-cover">
        <div class="col-md-4 order-md-2 mb-4 d-none d-md-block" style="margin-top:20px">
         <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Important Tips</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                <div id="accordion">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                          Choosing a name
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                        3
                        wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                        laborum
                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                        nulla
                      </div>
                    </div>
                  </div>
                  <div class="card card-danger">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                          Choosing Your shop category
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                        3
                        wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                        laborum
                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                        nulla
                        assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                        nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                        beer
                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                        labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="card card-success">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                          Collapsible Group Success
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                        3
                        wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                        laborum
                        eiusmod. Brunch 3 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
		
		
        <div class="col-md-8 order-md-1">
		<?php if(!isset($_POST["st1"])){?>
			<h6 class="text-bold text-orange">Step 1 of 3</h6>
          <h5 class="mb-3 product-cover text-center">Shop Information</h5>
		  <h6 class="mb-3 text-center"><u>Tell us more about your shop</u></h6>
		<form class="product-cover" id="f1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h5>Name Your Shop</h5>
			<div class="mb-3">
              <label for="address">Name  </label>
              <input type="text" class="form-control namesearch" name="name" placeholder="Enter name(Max 30 Characters)" autocomplete="off" required>
			  <div class="text-left text-xs text-danger" id="nameerr">
                  
                </div>
            </div>
		    <br/>
		  <h5>Shop Contact Info</h5>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter Email Address" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="phone">Phone number</label>
                <input type="text" class="form-control" name="phone" placeholder="" value="" autocomplete="off" required data-inputmask='"mask": "+254 999 999 999"' data-mask>
              </div>
            </div>
			<input type="hidden" name="st1" value=" ">
			<br/>
			<button type="submit" name="st2" class="btn btn-dark float-right">Next Step</button>
			</form>
		<?php } elseif(isset($_POST["st4"])){
				$_SESSION["f2cat"] = $_POST["cat"];
				$_SESSION["f2desc"] = $_POST["desc"];
			?>
			<h6 class="text-bold text-orange">Step 1 of 3</h6>
          <h4 class="mb-3 product-cover text-center">Shop Information</h4>
		  <h6 class="mb-3 text-center"><u>Tell us more about your shop</u></h6>
		<form class="product-cover" id="f1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h5>Name Your Shop</h5>
			<div class="mb-3">
              <label for="address">Name  </label>
              <input type="text" class="form-control namesearch" name="name" value="<?php echo $_SESSION["f1name"];?>" placeholder="Enter name(Max 30 Characters)" autocomplete="off" required>
			  <div class="text-left text-xs text-danger" id="nameerr"></div>
            </div>
		    <br/>
		  <h5>Shop Contact Info</h5>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter Email Address" value="<?php echo $_SESSION["f1email"];?>" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="phone">Phone number</label>
                <input type="text" class="form-control" name="phone" placeholder="" value="<?php echo $_SESSION["f1phone"];?>" autocomplete="off" required data-inputmask='"mask": "+254 999 999 999"' data-mask>
              </div>
            </div>
			<input type="hidden" name="st1" value=" ">
			<br/>
			<button type="submit" name="st2" class="btn btn-dark float-right">Next Step</button>
			</form>
		<?php } elseif(isset($_POST["st2"])){
			if(isset($_POST["name"])){
				$_SESSION["f1name"] = $_POST["name"];
				$_SESSION["f1email"] = $_POST["email"];
				$_SESSION["f1phone"] = $_POST["phone"];
			}
			if(isset($_POST["mpesa"])){
				$_SESSION["f3mpesa"] = $_POST["mpesa"];
			} 
		?>
			<h6 class="text-bold text-orange">Step 2 of 3</h6>
			 <h4 class="mb-3 product-cover text-center">Shop Details</h4>
			 <h6 class="mb-3 text-center"><u>Describe your shop</u></h6>
		    <h5>Shop Details</h5>
			<form class="product-cover" id="f2" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="mb-3">
              <label for="country">What Product category does you deal in</label>
                <select class="custom-select d-block w-100" name="cat" required>
					<?php if(isset($_SESSION["f2cat"])){
						$res = $pdo->query('SELECT * FROM category WHERE category_id='.$_SESSION["f2cat"].'');
					    $row = $res->fetch_assoc();
						echo '<option value="'.$row["category_id"].'">'.$row["category"].'</option>';
						}else{
							echo '<option value="">Choose...</option>';
						}?>
                  <?php 
					$res = $pdo->query("SELECT * FROM category");
					while ($row = $res->fetch_assoc()){
						echo '<option value="'.$row["category_id"].'">'.$row["category"].'</option>';
					}
				  ?>
                </select>
            </div>	
            <div class="mb-3">
              <label for="email">Shop Description</label>
              <textarea placeholder="Slogan or Brief description of the shop. Make it sweet. " class="form-control" name="desc"  required style="height:170px" ><?php if(isset($_SESSION["f2desc"])){ echo $_SESSION["f2desc"];}?></textarea>
            </div>
			<input type="hidden" name="st1" value=" ">
			<br/>
			<button type="submit" name="st4" class="btn btn-dark float-left">Previous Step</button>
			<button type="submit" name="st3" class="btn btn-dark float-right">Next Step</button>
			</form>
			<?php } elseif(isset($_POST["st3"])){ 
				$_SESSION["f2cat"] = $_POST["cat"];
				$_SESSION["f2desc"] = $_POST["desc"];
			?>
			<h6 class="text-bold text-orange">Step 3 of 3</h6>
			 <h4 class="mb-3 product-cover text-center">Payment Information</h4>
			 <h6 class="mb-3 text-center"><u>Enter M-Pesa number to recieve payments</u></h6>
		    <h6>How will you recieve payments?</h6>
			<form class="product-cover" id="f3" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="mb-3">
              <label for="address2">M-Pesa Number</label>
              <input type="text" class="form-control" id="address2" value="<?php if(isset($_SESSION["f3mpesa"])){ echo $_SESSION["f3mpesa"];}?>" name="mpesa" placeholder="Enter M-Pesa Number to recieve payments" autocomplete="off" required data-inputmask='"mask": "+254 999 999 999"' data-mask>
            </div>
			<input type="hidden" name="st1" value=" ">
			<br/>
			<div class="row">
			<span class="col-sm-6">
			<button type="submit" name="st2" class="btn btn-dark float-left mb-3">Previous Step</button>
			</span>
            <button class=" col-sm-6 btn bg-orange float-right" name="finalsub" type="submit"><span class="text-bold text-white">Open Your Shop</span></button>
			</div>
          </form>
			<?php } ?>
        </div>
      </div>
    </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
			  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
<?php include "includes/footer.php";?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include "includes/scripts.php";?>
<script>  
 $(document).ready(function(){  
      $('.namesearch').on("keyup input", function(){
           var inputVal = $(this).val(); 
           $.ajax({  
                url:"processes/check-name.php",  
                method:"POST",  
                data:{inputVal:inputVal},  
                success:function(data){  
                     $('#nameerr').html(data);  
                }  
           });		   
      });  
 });  
 </script>
<script>
$(document).ready(function(){
$.validator.addMethod( "nowhitespace", function( value, element ) {
	return this.optional( element ) || /^\S+$/i.test( value );
}, "Name can only consist of letters" );
$.validator.addMethod( "lettersonly", function( value, element ) {
	return this.optional( element ) || /^[a-z]+$/i.test( value );
}, "Name can only consist of letters" );
$.validator.addMethod( "integer", function( value, element ) {
	return this.optional( element ) || /^-?\d+$/.test( value );
}, "A positive or negative non-decimal number please" );

  })
</script>
<script>
$(function () {
  $('#f1').validate({
    rules: {
      name: {
        required: true,
		maxlength: 30,
		minlength: 3,
      },
	  phone: {
        required: true,
      }, 
	  email: {
        required: true,
        email: true,
		maxlength: 50,
      },
    },
    messages: {
	   name: {
        required: "Please enter a shop name",
      },
	   phone: {
        required: "Please enter a phone number",
      },
      email: {
        required: "Please enter an email address",
        email: "Please enter a vaild email address"
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.mb-3').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
<script>
$(function () {
  $('#f2').validate({
    rules: {
      cat: {
        required: true,
      },
	  desc: {
        required: true,
      }, 
    },
    messages: {
	   cat: {
        required: "Please enter a shop category",
      },
	   desc: {
        required: "Please describe your shop",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.mb-3').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
<script>
$(function () {
  $('#f3').validate({
    rules: {
      mpesa: {
        required: true,
      },
    },
    messages: {
	   mpesa: {
        required: "Please enter an M-Pesa number that will recieve payments",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.mb-3').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

</body>
</html>