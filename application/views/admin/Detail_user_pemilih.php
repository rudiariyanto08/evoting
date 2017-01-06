<?php  include('Header.php');?>
<?php 
	if(isset($user_data)){
		foreach ($user_data as $user) {
			$nim = $user->nim;
			$nama = $user->nama;
			$jurusan = $user->jurusan;
			$no_telp = $user->no_telp;
			$pass = md5($user->password);
			$name = $user->name;
		}
	}
?>
<div class="container">
	<div class="row">
		<div class="card black-text">
			<div class="card content">
				<div class="row">
					<div class="col s12">
					    <ul class="tabs ">
					        <li class="tab col s3"><a href="#profile" class="blue-text">Profil Info</a></li>
					         <li class="tab col s3"><a href="#info" class="blue-text">Update Info</a></li>
					        <li class="tab col s3"><a href="#akun" class="blue-text">Update Akun</a></li>
					        <li class="tab col s3"><a href="#photo" class="blue-text">Update Photo</a></li>
					    </ul>
					    </div>
					    <div class="row" style="min-height: 50px"> 

					    </div>
					    <!--Profile-->
					    <div id="profile" class="col s12">
					    	<div class="row"></div>
					    		<div class="col s5">
					    			<?php
					    				$image = base_url();
				          				$path = "/pictures/";
				          				$properti = array(
				                        'src' => $image.$path.$name,
				                        'width' => '',
				                        'height'=> '200',
				                        'class'	=> 'responsive-img'
						                      );
						                  echo img($properti);
					    			?>
					    			<div class="col s12" style="min-height: 50px"></div>
					    		</div>
					    		<div class="col s7">
					    			<table class="striped">
					    				<tbody>
					    					<tr>
					    						<td><b>NIM</b></td>
					    						<td>:&nbsp<?php echo $nim?></td>
					    					</tr>
					    					<tr>
					    						<td><b>Nama</b></td>
					    						<td>:&nbsp<?php echo $nama?></td>
					    					</tr>
					    					<tr>
					    						<td><b>Jurusan</b></td>
					    						<td>:&nbsp<?php echo $jurusan?></td>
					    					</tr>
					    					<tr>
					    						<td><b>No. Telp</b></td>
					    						<td>:&nbsp<?php echo $no_telp?></td>
					    					</tr>
					    				</tbody>
					    			</table>
					    		</div>
					    </div>

					    <!--End Profile-->
					  	<!--Update Info-->
					  	<div id="info" class="col s12">
					  		<div class="row">
					  		<?php echo form_open();?>
					  			<div class="col s6 offset-s3">
								     <div class="row">
								        <div class="input-field col s12">
								          <i class="material-icons prefix">account_circle</i>
								          <input id="nama" type="text" class="validate" name="nama" value="<?php echo $nama;?>">
								          <label for="nama">Nama</label>
								        </div>
								        <div class="input-field col s12">
								          <i class="material-icons prefix">phone</i>
								          <input id="telepone" type="text" class="validate" name="no_telp" value="<?php echo $no_telp;?>">
								          <label for="telepone">Telephone</label>
								        </div>
								         <div class="input-field col s12">
										    <select name="jurusan" id="jurusan">
										      <option value="" disabled selected>Pilih Jurusan</option>
										      <option value="Teknik Elektro">Teknik Elektro</option>
										      <option value="Teknik Sipil">Teknik Sipil</option>
										      <option value="Teknik Mesin" >Teknik Mesin</option>
										      <option value="Akuntansi" >Akuntansi</option>
										      <option value="Administrasi Niaga">Administrasi Niaga</option>
										      <option value="Pariwisata" >Pariwisata</option>
										    </select>
										    <label>Jurusan</label>
										  </div>
										 <button class="btn waves-effect waves-light #1976d2 blue darken-2 submit1" type="submit" name="action">Update
										  </button>
										  <button class="btn waves-effect waves-light #1976d2 blue darken-2" type="reset" name="action">Cancel
										  </button>		 
									</div>
					 			</div>
					 			<?php echo form_close();?>
					 		</div>
						</div>
						<!--End Update Info-->
						<!--Update Akun-->
						<div id="akun" class="col s12">
						<?php echo form_open();?>
							<div class="row">
							<div class="col s6 offset-s3">
								    <div class="row">
								    	<div class="input-field col s12">
								          <i class="material-icons prefix">account_circle</i>
								          <input id="nim" type="text" class="validate" name="nim" value="<?php echo $nim;?>" readonly>
								          <label for="nim">NIM</label>
								        </div>
								        <div class="input-field col s12">
								          <i class="material-icons prefix">visibility_off</i>
								          <input id="pass" type="password" class="validate" name="pass" >
								          <label for="pass">Password</label>
								        </div>
								    </div>
								     <button class="btn waves-effect waves-light #1976d2 blue darken-2 submit2" type="submit" name="action">Update
										  </button>
										  <button class="btn waves-effect waves-light #1976d2 blue darken-2" type="reset" name="action">Cancel
										  </button>	
							</div>
						</div>
						<?php echo form_close();?>
						</div>
						<!--End Update Info-->
						<!--Update Photo-->
						<div id="photo" class="col s12">
						<?php echo form_open_multipart('Admin/photo');?>
							<div class="row">
								<div class="col s4 offset-s2" style="margin-left: 40px">
						    			<?php
						    				$image = base_url();
					          				$path = "/pictures/";
					          				$properti = array(
					                        'src' => $image.$path.$name,
					                        'width' => '',
					                        'height'=> '200',
					                        'id'	=> 'output',
					                        'class'	=>'responsive-img'
							                      );
							                  echo img($properti);
						    			?>
						    			<div class="col s12" style="min-height: 50px;"></div>
										
							</div>
								<div class="col s6">
									<div class="file-field input-field" >
							      		<div class="btn #1976d2 blue darken-2">
								        <span>File</span>
								        <input type="file" name="imgName" id="imgName" onchange="loadFile(event)">
							      		</div>
									    <div class="file-path-wrapper">
									     <input class="file-path validate" type="text" name="imgName" onchange="loadFile(event)">
									      </div>
									 </div>
									 <div class="center">
									 	<button class="btn waves-effect waves-light #1976d2 blue darken-2 submit3" type="submit" name="action">Update
										  </button>
									 </div>
								</div>	
							</div>
							<?php echo form_close();?>
						</div>
						<!--End Update Photo-->
		</div>
	</div>
</div>
<script type="text/javascript">
	  $(document).ready(function() {
    $('select').material_select();
  });
        
</script>
<script type="text/javascript">
$(document).ready(function() {
			$(".submit1").click(function(event) {
			event.preventDefault();
			var nama 		= $("#nama").val();
			var telepone 	= $("#telepone").val();
			var jurusan 	= $("#jurusan").find("option:selected").val();			
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>"+"admin/update_info_pemilih",
			dataType: 'json',
			data: {nama: nama, no_telp:telepone, jurusan:jurusan},
			success: function(res) {
				if(res.hasil == 'true'){
					swal({
						title: "Edit Sukses",
						text: "Data Berhasil di Edit",
						showConfirmButton: true,
						confirmButtonColor: '#0760ef',
						type:"success"
					},
					function(){
					  window.location.href = "<?php echo site_url('admin/daftar_user'); ?>";
					});
	
				}
			}
		});
	});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
			$(".submit2").click(function(event) {
			event.preventDefault();
			var pass 	= $("#pass").val();		
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>"+"admin/update_akun",
			dataType: 'json',
			data: {pass: pass},
			success: function(res) {
				if(res.hasil == 'true'){
					swal({
						title: "Edit Sukses",
						text: "Akun berhasil di update",
						showConfirmButton: true,
						confirmButtonColor: '#0760ef',
						type:"success"
					},
					function(){
					  window.location.href = "<?php echo site_url();?>";
					});
	
				}
			}
		});
	});
});
</script>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
<?php include('Footer.php');?>