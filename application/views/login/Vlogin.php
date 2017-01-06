<?php include('Header.php'); ?>
	<div class="container">
	<div class="row">
		<div class="col s8">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Cara Login</span>
					<p>
						<ul style="list-style-type:decimal;">
							<li>1. Untuk login silahkan masukkan NIM dan Password yang diberikan oleh panitia</li>
							<li>2. Setelah login berhasil, silahkan isi form Re-registrasi untuk melengkapi data diri</li>
							<li>3. Pastikan kalian merubah Password agar memudahkan untuk login selanjutnya</li>
							<li>4. Jika password yang diberikan panitia tidak bisa, silahkan hubungi pihak panitia di Pos panitia</li>
							<li>5. Jika belum memiliki nim dan password untuk login, silahkan hubungi panitia</li>
						</ul>
					</p>
				</div>
			</div>		
		</div>
		<div class="col s4">
			<?php echo form_open()?>
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="input-field col s6 m12">
							<i class="material-icons prefix">account_circle</i>
							<input id="nim" type="text" class="validate" name="nim">
							<label for="nim">NIM</label>
							</div>
							<div class="input-field col s6 m12">
							<i class="material-icons prefix">visibility_off</i>
							<input id="password" type="password" class="validate" name="password">
							<label for="password">Password</label>
							</div>
							<div class="col s6 m12">
							<button type="submit" value="login" class="waves-effect waves-light btn #1976d2 blue darken-2 submit1">LOGIN</button>
							<button type="reset" value="cancel" class="waves-effect waves-light btn #1976d2 blue darken-2">CANCEL</button>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close()?>
		</div>
	</div>
	</div>

	<script type="text/javascript">
$(document).ready(function() {
			$(".submit1").click(function(event) {
			event.preventDefault();
			var nim		= $("#nim").val();
			var password	= $("#password").val();		
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>"+"Login/check_login",
			dataType: 'json',
			data: {nim:nim, password:password},
			success: function(res) {
				if(res.hasil == 'a'){
					window.location.href = "<?php echo site_url('Admin');?>";
				}else if(res.hasil == 'u'){
					window.location.href = "<?php echo site_url('User');?>";
					
				}else{
					swal({
						title: "Login Gagal",
						text: "Pastikan NIM dan Password Benar",
						showConfirmButton: true,
						confirmButtonColor: '#0760ef',
						type:"error"});
				}
			}
		});
	});
});
</script>
<?php include('Footer.php');?>
