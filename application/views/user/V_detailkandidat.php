<?php include('Header.php');?>
<div class="container" style="margin-top: 1%">
	<div class="row">
		<?php 
		foreach ($detail_kandidat as $kandidat) {
			$nim = $kandidat->nim;
			$nama = $kandidat->nama;
			$jurusan = $kandidat->jurusan;
			$no = $kandidat->no_kandidat;
			$jabatan = $kandidat->jabatan;
			$name = $kandidat->name;
			$visi = $kandidat->visi;
			$misi = $kandidat->misi;
			?>

		<div class="col s3">
			<?php
				$image = base_url();
				$path = "/pictures/";
				$properti = array(
				'src' => $image.$path.$name,
				'width' => '',
				'height'=> '200',
				'class' => 'responsive-img'
				);
				echo img($properti);
			?>	
		</div>
			<div class="col s3">
			<table class="striped">
				<tr><td><?php echo $nim?></td></tr>
				<tr><td><?php echo $nama?></td></tr>
				<tr><td><?php echo $jurusan?></td></tr>
				<tr><td><?php echo $jabatan?></td></tr>
			</table> 
			</div>
		<?php }
	?>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="card panel">
				<div class="card context">
					<div class="row">
						<div class="col s10 offset-s1">
							<h5 class="center">Visi</h5>
							<p><?php echo $visi;?></p>
						</div>
						<div class="col s10 offset-s1">
							<h5 class="center">Misi</h5>
							<p><?php echo $misi;?></p>
						</div>
						<div class="center col s12">
						<button class="btn waves-effect waves-light #1976d2 blue darken-2 submit1" style="margin-bottom: 10px;" <?php echo $disable;?>>Vote Now</button>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
			$(".submit1").click(function(event) {
			event.preventDefault();
			var no = <?php echo $no;?>;
			jQuery.ajax({
			type: "GET",
			url: "<?php echo base_url(); ?>"+"user/hasil_voting",
			dataType: 'json',
			data: {no:no},
			success: function(res) {
				if(res.hasil == 'true'){
					swal({
						title: "Vote Berhasil",
						text: "Terima Kasih Sudah Berpatisipasi",
						showConfirmButton: true,
						confirmButtonColor: '#0760ef',
						type:"success"
					},
					function(){
					  window.location.href = "<?php echo site_url()?>";
					});
	
				}
			}
		});
	});
});
</script>
<?php include('Footer.php');?>