<!DOCTYPE html>
<html>
<head>
	<title>PNB E-Voting</title>
	<link rel="shortcut icon" href="http://www.pnb.ac.id/wp-content/uploads/2016/12/Logo-Politeknik-Negeri-Bali-tranpasaran-cupu-putih-100.png" type="image/x-icon">
	
	
	<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/chingyawhao/materialize-clockpicker/master/dist/css/materialize.clockpicker.css"/>
	  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

  
          

      <!-- Sweet Alert CSS import-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/sweetalert-master/dist/sweetalert.css">
    <style type="text/css">
    	  body {
			    display: flex;
			    min-height: 100vh;
			    flex-direction: column;
			  }

  			main {
			    flex: 1 0 auto;
			  }
    </style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php
    	if(isset($this->session->userdata['logged_in'])){
    		$nim = ($this->session->userdata['logged_in']['nim']);
    		$nama = ($this->session->userdata['logged_in']['nama']);
    		$name = ($this->session->userdata['logged_in']['gambar']);
    	}
    	else {
		header("location: login");
		}
    ?>
</head>
<body>
	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/sweetalert-master/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
	<script type="text/javascript" src="https://cdn.rawgit.com/chingyawhao/materialize-clockpicker/master/dist/js/materialize.clockpicker.js"></script>
	
	<!--Start Navbar E-Voting PNB-->
	<main>
	<nav>
		<div class="nav-wrapper #1976d2 blue darken-2">
			<div class="container #1976d2 blue darken-2">
				<a href="<?php echo site_url('admin')?>" class="brand-logo"><img src="http://www.pnb.ac.id/wp-content/uploads/2016/12/LOGO-PNB-WEB-2016-putih.png" alt="" class="responsive-img" style="height: 55px; padding-top: 6px;"></a>
				<ul class="right hide-on-med-and-down">
					<li><a href="<?php echo site_url('Admin/pesan');?>" class="valign-wrapper"> 
					<i class="material-icons">message</i>Message</a></li>
					<li><a href="<?php echo site_url('Admin/startvoting');?>" class="valign-wrapper"> 
					<i class="material-icons">settings_power</i>Start Voting</a></li>
					 <li><a class="dropdown-button valign-wrapper" href="#!" data-activates="dropdown1" data-beloworigin="true">
          				<?php
          				$image = base_url();
          				$path = "pictures/";
          				$properti = array(
		                        'src' => $image.$path.$name,
		                        'width' => '50',
		                        'height'=> '50',
		                        'class'	=> 'circle'
				                      );
				                  echo img($properti);
				                  echo "&nbsp &nbsp &nbsp";
				                  echo $nama
		          				?>
          				<i class="material-icons right">arrow_drop_down</i></a>
			              <ul id='dropdown1' class='dropdown-content' href="#!" data-activates="dropdown1" data-beloworigin="true">
			                    <li><a href="<?php echo site_url('admin/user_akun?id='.$nim)?>" class="blue-text">Edit Profile</a></li>
			                    <li><a href="<?php echo site_url('user')?>" class="blue-text">Login As User</a></li>
			                    <li><a href="<?php echo site_url('login/logout')?>" class="blue-text">Logout</a></li>
			              </ul>
          			</li>
				</ul>
			</div>
		</div>
	</nav>
	<style type="text/css">
		::-webkit-scrollbar              { 
			width: 15px;
		}
		::-webkit-scrollbar-button       { /* 2 */ }
		::-webkit-scrollbar-track        { 
		 }
		::-webkit-scrollbar-track-piece  { /* 4 */ }
		::-webkit-scrollbar-thumb        { 
  		-webkit-box-shadow: inset 0 0 15px rgb(52, 152, 219); 
		}
		::-webkit-scrollbar-corner       { /* 6 */ }
		::-webkit-resizer                { /* 7 */ }
	</style>