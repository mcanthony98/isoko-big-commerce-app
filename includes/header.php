<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $headtitle;?></title>
  <meta name="Description" content="<?php echo $headdesc;?>">
  <meta name="Keywords" content="<?php echo $headkeywords;?>">

  <link rel="shortcut icon" href="img/isoko7.jpg">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	
	<style>
	.product-cover{
		padding-top:10px;
	}
	.p-btm{
		padding-bottom:10px;
	}
	.zoom {
  transition: transform .2s; 
  margin: 0 auto;
}

.zoom:hover {
  transform: scale(0.9);
}



 /* Formatting search box */
    .ssearch-box{
        width: 225px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .ssearch-box input[type="text"]{
        height: 32px;
        padding: 5px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
	.ssearch-box button {
		  float: right;
		  width: 15%;
		  height: 32px;
		  padding: 1px;
		  background: grey;
		  color: white;
		  font-size: 14px;
		  border: 1px solid grey;
		  border-left: none;
		  cursor: pointer;
}
    .sresult{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
		background-color:white;
    }
    .ssearch-box input[type="text"], .sresult{
        width: 85%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .sresult p{
        margin: 0;
        padding: 6px 10px;
        cursor: pointer;
		
    }
    .sresult p:hover{
        background: #f2f2f2;
    }
	.zoompic:hover {
  transform: scale(1.005); 
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.19);
}
.displayname {
  display: block;
  width: 100%;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.note-danger {
  background-color: #ffdddd;
  border-left: 6px solid #f44336;
  padding:10px;
}
.note-warning {
  background-color: #ffffcc;
  border-left: 6px solid #ffeb3b;
}
	</style>
</head>