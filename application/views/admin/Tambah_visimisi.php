<?php  include('Header.php');?>
<div class="container">
	<div class="row" style="margin-top: 75px">
		<div class="col s12">
							<div class="row">
								<?php echo form_open();?>
									<div class="col s6 offset-s3">
										<div class="row">
										 <div class="input-field col s12">
								          <i class="material-icons prefix">account_circle</i>
								          <input id="no" type="number" class="validate" name="no" value="<?php echo $no->no_kandidat+1;?>" readonly>
								          <label for="no">No Kandidat</label>
								        </div>
										    <div class="input-field col s12">
										        <textarea id="visi" class="materialize-textarea" name="visi"></textarea>
										        <label for="visi">Visi</label>
										    </div>
										     <div class="input-field col s12">
										        <textarea id="misi" class="materialize-textarea" name="misi"> </textarea>
										        <label for="misi">Misi</label>
										    </div>
										    <button class="btn waves-effect waves-light #1976d2 blue darken-2 submit" type="submit" name="action">Tambah
										  </button>
										  <button class="btn waves-effect waves-light #1976d2 blue darken-2" type="reset" name="action">Cancel
										  </button>
										</div>
									</div>
								<?php echo form_close();?>
							</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
			$(".submit").click(function(event) {
			event.preventDefault();
			var no = $("#no").val();
			var visi = $("#visi").val();
			var misi = $("#misi").val();			
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>"+"admin/proses_tambah_visimisi",
			dataType: 'json',
			data: {no:no, visi:visi, misi:misi},
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
					  window.location.href = "<?php echo site_url('admin/visimisi'); ?>";
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
					  window.location.href = "<?php echo site_url('admin/visimisi'); ?>";
					});
				}
			}
		});
	});
});
</script>
<?php include('Footer.php');?>