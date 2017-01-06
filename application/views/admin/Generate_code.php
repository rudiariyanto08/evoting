<?php include('Header.php');?>
	<div class="row">
		<div class="container">
			<div class="col s5 offset-s3">
				<div class="card">
					<div class="card-content">
					<?php echo form_open();  ?>
					<?php echo validation_errors(); ?>
						<div class="row">
					        <div class="input-field col s12">
					        <i class="material-icons prefix">account_circle</i>
					        <input id="nim" type="text" class="validate" name="nim">
					        <label for="nim">NIM</label>
			        	</div>
			        	</div>
			        	<div class="row">
					        <div class="input-field col s12">
					        <i class="material-icons prefix">perm_identity</i>
					        <input id="nama" type="text" class="validate" name="nama">
					        <label for="nama">Nama</label>
			        	</div>
			        	</div>
			        	<div class="row">
					        <div class="input-field col s12">
					        <i class="material-icons prefix">visibility</i>
					        <input id="pass" type="text" class="validate" name="password" readonly>
					        <label for="pass"></label>
			        	</div>
			        	<p style="margin-left: 10px" class="user">
						      <input name="user" type="radio" id="test1" value="a" />
						      <label for="test1">Admin</label>
						      <input name="user" type="radio" id="test2" value="u" />
						      <label for="test2">User</label>
						</p>
					</div>
					<button type="button" class="waves-effect waves-light btn #1976d2 blue darken-2" onclick="generate()">Generate Code</button>
					<button type="Submit" class="waves-effect waves-light btn #1976d2 blue darken-2 submit">Submit</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

	<script type="text/javascript">
		function generate() {
			var text = " ";
    		var charset = document.getElementById('nim').value;
    
    		for( var i=0; i < 10; i++ )
       		 text += charset.charAt(Math.floor(Math.random() * charset.length));
			document.getElementById('pass').value = text;
		}
	</script>
	<script type="text/javascript">
$(document).ready(function() {
			$(".submit").click(function(event) {
			event.preventDefault();
			var nim= $("#nim").val();
			var nama = $("#nama").val();
			var password = $("#pass").val();
			var akses = $('.user input[type="radio"]:checked:first').val();			
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>"+"admin/tambah_user",
			dataType: 'json',
			data: {nim: nim, nama: nama, password:password, user:akses},
			success: function(res) {
				if(res.hasil == 'true'){
					swal({
						title: "Sukses",
						text: "Data Di Tambahkan",
						showConfirmButton: true,
						confirmButtonColor: '#0760ef',
						type:"success"
					},
					function(){
					  window.location.href = "<?php echo site_url('admin/daftar_user'); ?>";
					});
				}
				if(res.hasil == 'false'){
					swal({
						title: "Gagal",
						text: "Duplicate Entry :'(",
						showConfirmButton: true,
						confirmButtonColor: '#0760ef',
						type:"error"
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
<?php include('Footer.php');?>