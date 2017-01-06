<?php include('Header.php');?>
<?php foreach ($data as $key) {
		$id = $key->id_peng;
		$judul = $key->judul;
		$desc = $key->deskripsi;
	} ?>
<div class="row">
	<div class="container">
		<h4 class="blue-text text-lighten-2">Tambah Pengumuman</h4>
	<?php echo form_open(); ?>
	
		<div col s7>
			 <div class="row">
		        <div class="input-field col s7">
		          <i class="material-icons prefix">new_releases</i>
		          <input id="judul" type="text" class="validate" name="judul" value="<?php echo $judul; ?>">
		          <label for="judul">Judul</label>
		        </div>
		</div>
		<div class="row">
		        <div class="input-field col s7">
		          <i class="material-icons prefix">mode_edit</i>
		          <textarea id="keterangan" class="materialize-textarea" name="keterangan"><?php echo $desc;?></textarea>
		          <label for="keterangan">Keterangan/isi pengumuman</label>
		        </div>
      	</div>
      	<button type="submit" class="waves-effect waves-light btn #1976d2 blue darken-2 submit">Edit</button>
		<button type="reset"  class="waves-effect waves-light btn #1976d2 blue darken-2">Cancel</button>
	<?php echo form_close(); ?>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
			$(".submit").click(function(event) {
			event.preventDefault();
			var judul= $("#judul").val();
			var desc = $("#keterangan").val();			
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>"+"admin/proses_edit_pengumuman",
			dataType: 'json',
			data: {judul: judul, keterangan: desc},
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
					  window.location.href = "<?php echo site_url('admin/daftar_pengumuman'); ?>";
					});
	
				}
			}
			});
			});
			});
</script>
<?php include('Footer.php');?>