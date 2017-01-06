<style type="text/css">
	.hidden{
		display: none;
	}
</style>
<?php error_reporting(0);?>
<?php include('Header.php');?>
	<div class="container">
		<div class="row">
			<div class="card panel">
				<div class="card-content">
					<?php if(isset($tgl_voting)) 
						{
							
							foreach ($tgl_voting as $key => $voting) {
								$id = $voting->id; 
								$tgl_start = $voting ->start;
								$tgl_end = $voting->end;
								$tgl1 = date('d M Y', strtotime($tgl_start));
								$jam1 =date('H:i', strtotime($tgl_start));
								$tgl2 = date('d M Y', strtotime($tgl_end));
								$jam2 =date('H:i', strtotime($tgl_end)); 
								?>
								<div class="row">
									<div class="col s12 m12">
										<div class="card-panel center">
											<h5 class="black-text">Voting Sudah di Mulai...</h5>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col s6 m6">
										<div class="card-panel">
											<h4 class="black-text">Mulai :</h4>
											<h5 class="black-text">Jam -> <?php echo "".$jam1?></h5>
											<h5 class="black-text">Tanggal -> <?php echo "".$tgl1?></h5>
										</div>
									</div>
									<div class="col s6 m6">
										<div class="card-panel">
											<h4 class="black-text">Selesai :</h4>
											<h5 class="black-text">Jam -> <?php echo "".$jam2?></h5>
											<h5 class="black-text">Tanggal -> <?php echo "".$tgl2?></h5>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col s12">
									<button class="btn waves-effect waves-light blue right" onclick="hapus(<?php echo $id?>)">HAPUS</button>
									 <a class="waves-effect waves-light btn blue right" href="#modal1" style="margin-right: 10px">EDIT</a>
									</div>
								</div>
							<?php }
						}else{


					?>
					<?php echo form_open();?>
						<div class="row">
							<div class="col s6 offset-s2">
								<label for="start">Start</label>
								<input type="date" class="datepicker" name="start" id="start">
							</div>
							<div class="col s2">
							 <label for="timepicker_ampm_dark">Jam</label>
								<input id="timepicker_ampm_dark" class="timepicker" type="time" name="waktu_start">
							</div>
							<div class="col s6 offset-s2">
								<label>End</label>
								<input type="date" class="datepicker" name="end">
							</div>
							<div class="col s2">
							 <label for="timepicker_ampm_dark">Jam</label>
								<input id="timepicker_ampm_dark" class="timepicker" type="time" name="waktu_end">
							</div>
							<div class="col s6 offset-s3 center">
								<button class="btn waves-effect waves-light #1976d2 blue darken-2 submit" type="submit">Submit</button>
							</div>
						</div>
					<?php echo form_close();?>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
	<div id="modal1" class="modal">
    	<div class="modal-content">
				<?php echo form_open();?>
						<div class="row">
							<div class="col s6 offset-s2">
								<label for="start">Start</label>
								<input type="date" class="datepicker" name="start" id="start" value="<?php echo $tgl1?>">
							</div>
							<div class="col s2">
							 <label for="timepicker_ampm_dark">Jam</label>
								<input id="timepicker_ampm_dark" class="timepicker" type="time" name="waktu_start" value="<?php echo $jam1;?>">
							</div>
							<div class="col s6 offset-s2">
								<label>End</label>
								<input type="date" class="datepicker" name="end" value="<?php echo $tgl2?>">
							</div>
							<div class="col s2">
							 <label for="timepicker_ampm_dark">Jam</label>
								<input id="timepicker_ampm_dark" class="timepicker" type="time" name="waktu_end" value="<?php echo $jam2;?>">
							</div>
							<div class="col s6 offset-s3 center">
								<button class="btn waves-effect waves-light #1976d2 blue darken-2 submit2" type="submit">Submit</button>
							</div>
						</div>
					<?php echo form_close();?>
				</div>
		</div>
<script type="text/javascript">
	 $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
</script>
<script type="text/javascript">
	 $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15,// Creates a dropdown of 15 years to control year
  });
</script>
<script type="text/javascript">
	$('.timepicker').pickatime({
    default: 'now',
    timeFormat: 'HH:mm:ss',
    twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
    donetext: 'OK',
  autoclose: false,
  vibrate: true // vibrate the device when dragging clock hand
});
</script>
<script type="text/javascript">
$(document).ready(function() {
			$(".submit").click(function(event) {
			event.preventDefault();
			var start = $("input[name=start]").val();
			var waktu_start= $("input[name=waktu_start]").val();
			var end= $("input[name=end]").val();
			var waktu_end= $("input[name=waktu_end]").val();	
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>"+"admin/datevoting",
			dataType: 'json',
			data: {start:start, waktu_start:waktu_start, end:end, waktu_end:waktu_end},
			success: function(res) {
				if(res.hasil == 'true'){
					swal({
						title: "Voting Started",
						text: "Voting Berhasil dimulai silahkan tambahkan pengumuman",
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
<script type="text/javascript">
	function hapus(id){
		var id = id;
		swal({
		  title: "Data Akan dihapus?",
		  text: "Data yang sudah dihapus tidak bisa dikembalikan!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#0760ef",
		  confirmButtonText: "Ya, Hapus!",
		  cancelButtonText: "Batal!",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm){
		  if (isConfirm) {
		  	jQuery.ajax({
			type: "GET",
			url: "<?php echo base_url(); ?>"+"admin/delete_voting",
			dataType: 'json',
			data: {data:id},
			success: function(res){
				if(res.hasil='true'){
					swal({
						title: "Sukses",
						text: "Data Berhasil di Hapus",
						showConfirmButton: true,
						confirmButtonColor: '#0760ef',
						type:"success"
					},
					function(){
					  window.location.href = "<?php echo site_url(); ?>";
					});
				}
			}
			});
		  } else {
		    swal("Batal", "Data Aman.... :)", "error");
		  }
		});
	}
</script>
<script type="text/javascript">
$(document).ready(function() {
			$(".submit2").click(function(event) {
			event.preventDefault();
			var start = $("input[name=start]").val();
			var waktu_start= $("input[name=waktu_start]").val();
			var end= $("input[name=end]").val();
			var waktu_end= $("input[name=waktu_end]").val();	
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>"+"admin/update_voting",
			dataType: 'json',
			data: {id:<?php echo $id;?>,start:start, waktu_start:waktu_start, end:end, waktu_end:waktu_end},
			success: function(res) {
				if(res.hasil == 'true'){
					swal({
						title: "Voting Started",
						text: "Voting Berhasil diedit silahkan tambahkan pengumuman",
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