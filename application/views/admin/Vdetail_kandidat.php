<?php  include('Header.php');?>
<?php error_reporting(0);
	if(isset($data)){
		foreach ($data as $user) {
			$nim = $user->nim;
			$nama = $user->nama;
			$jurusan = $user->jurusan;
			$no = $user->no_kandidat;
			$jabatan = $user->jabatan;
			$name = $user->name;
			$visi = $user->visi;
			$misi = $user->misi;
		}
	}
?>
<div class="container">
	<div class="row">
		<div class="card teal-text">
			<div class="card content">
				<div class="row">
					<div class="col s12">
						    <ul class="tabs ">
						        <li class="tab col s3"><a href="#profile">Profil Info</a></li>
						         <li class="tab col s3"><a href="#info">Update Info</a></li>
						         <li class="tab col s3"><a href="#visi">Update Visi Misi</a></li>
						        <li class="tab col s3"><a href="#photo">Update Photo</a></li>
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
				                        'max-width' => '400',
				                        'height'=> '200',
				                        'class'=>'responsive-img'
						                      );
						                  echo img($properti);
					    			?>
					    			<div class="col s12" style="min-height: 50px"></div>
					    		</div>
					    		<div class="col s7">
					    			<table class="striped black-text">
					    				<tbody>
					    					<tr>
					    						<td><b>NIM</b></td>
					    						<td>:&nbsp<?php echo $nim;?></td>
					    					</tr>
					    					<tr>
					    						<td><b>Nama</b></td>
					    						<td>:&nbsp<?php echo $nama?></td>
					    					</tr>
					    					<tr>
					    						<td><b>Jurusan</b></td>
					    						<td>:&nbsp<?php echo $jurusan;?></td>
					    					</tr>
					    					<tr>
					    						<td><b>Jabatan</b></td>
					    						<td>:&nbsp<?php echo $jabatan;?></td>
					    					</tr>
					    					<tr>
					    						<td><b>Visi</b></td>
					    						<td>:&nbsp<?php echo $visi;?></td>
					    					</tr>
					    					<tr>
					    						<td><b>Misi</b></td>
					    						<td>:&nbsp<?php echo $misi;?></td>
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
								          <input id="nim" type="text" class="validate" name="nim" value="<?php echo $nim;?>" readonly>
								          <label for="nim">NIM</label>
								        </div>
								        <div class="input-field col s12">
								          <input id="nama" type="text" class="validate" name="nama" value="<?php echo $nama;?>">
								          <label for="nama">Nama</label>
								        </div>
								        <div class="input-field col s12">
								          <input id="kandidat" type="text" class="validate" name="kandidat" value="<?php echo $no;?>">
								          <label for="kandidat">No Kandidat</label>
								        </div>
								         <div class="input-field col s12">
										    <select name="jurusan" id="jurusan">
										      <option value="" disabled selected>Pilih Jurusan</option>
										      <option value="Teknik Elektro">Teknik Elektro</option>
										      <option value="Teknik Sipil">Teknik Sipil</option>
										      <option value="Teknik Mesin">Teknik Mesin</option>
										      <option value="Akuntansi">Akuntansi</option>
										      <option value="Administrasi Niaga">Administrasi Niaga</option>
										      <option value="Pariwisata">Pariwisata</option>
										    </select>
										    <label>Jurusan</label>
										  </div>
										  <div class="input-field col s12">
											 <select name="jabatan" id="jabatan">
												<option value="" disabled selected>Pilih Jabatan</option>
												<option value="Presma">Presma</option>
												<option value="Wapresma">Wapresma</option>
											</select>
											<label>Jabatan</label>
										</div>
										 <button class="btn waves-effect waves-light submit #1976d2 blue darken-2" type="submit" name="action">Update
										  </button>
										  <button class="btn waves-effect waves-light #1976d2 blue darken-2" type="reset" name="action">Cancel
										  </button>		 
									</div>
					 			</div>
					 			<?php echo form_close();?>
					 		</div>
						</div>
						<!--End Update Info-->
						<!-- Visi Misi -->
						<div id="visi" class="col s12">
							<div class="row">
								<?php echo form_open('admin/visi_misi');?>
									<div class="col s6 offset-s3">
										<div class="row">
										 <div class="input-field col s12">
								          <i class="material-icons prefix">account_circle</i>
								          <input id="icon_prefix" type="number" class="validate" name="no" value="<?php echo $no;?>">
								          <label for="icon_prefix">No Kandidat</label>
								        </div>
										    <div class="input-field col s12">
										        <textarea id="textarea1" class="materialize-textarea" name="visi"><?php echo $visi;?></textarea>
										        <label for="textarea1">Visi</label>
										    </div>
										     <div class="input-field col s12">
										        <textarea id="textarea1" class="materialize-textarea" name="misi"> <?php echo $misi;?></textarea>
										        <label for="textarea1">Misi</label>
										    </div>
										    <button class="btn waves-effect waves-light #1976d2 blue darken-2" type="submit" name="action">Update
										  </button>
										</div>
									</div>
								<?php echo form_close();?>
							</div>
						</div>
						<!--Update Photo-->
						<div id="photo" class="col s12">
						<?php echo form_open_multipart('admin/photo_kandidat_update');?>
							<div class="row">
							<div class="col s4 offset-s2" style="margin-left: 40px">
						    			<?php
						    				$image = base_url();
					          				$path = "pictures/";
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
								        <input type="file" name="imgName" onchange="loadFile(event)">
							      		</div>
									    <div class="file-path-wrapper">
									     <input class="file-path validate" type="text" name="imgName" onchange="loadFile(event)">
									      </div>
									 </div>
									 <div class="center">
									 	<button class="btn waves-effect waves-light #1976d2 blue darken-2" type="submit" name="action">Update
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
			$(".submit").click(function(event) {
			event.preventDefault();
			var nim 		= $("#nim").val();
			var nama 		= $("#nama").val();
			var kandidat 	= $("#kandidat").val();
			var jurusan 	= $("#jurusan").find("option:selected").val();
			var jabatan		= $("#jabatan").find("option:selected").val();		
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>"+"Admin/update_kandidat",
			dataType: 'json',
			data: {nim:nim, nama:nama, kandidat:kandidat, jurusan:jurusan, jabatan:jabatan},
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
					  window.location.href = "<?php echo site_url('Admin/vkandidat'); ?>";
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