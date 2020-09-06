<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    //Kenyan Phone numbers
    $('[data-mask]').inputmask()

  })
</script>
<script>  
 $(document).ready(function(){  
      $('.search-input').on("keyup input", function(){
           var inputVal = $(this).val();
           $.ajax({  
                url:"processes/search.php",  
                method:"POST",  
                data:{navsearch:inputVal},  
                success:function(data){  
                     $('#navsearch').html(data);  
                }  
           });		   
      });  
 });  
 </script>
 <script>
$(function () {
  $('#searchnav').validate({
    rules: {
      search: {
        required: true,
        maxlength: 35,
      },
    },
    messages: {
	   search: {
        required: " ",
        maxlength: " ",
      },
    },
  });
});
</script>