<?php include('Header.php');?>
	<?php error_reporting(0)?>
	<div class="container">
	<?php 
		date_default_timezone_set('Asia/Kuala_Lumpur');
		$date = date('Y-m-d H:i:s');
		if($date > $start && $date < $end){?>
			<div class="row">
				<div class="col s2">
					<div class="card">
						<div class="card-content" style="height: 90px;"><h5 id="hari" class="center"></h5></div>
					</div>
				</div>
				<div class="col s2">
					<div class="card">
						<div class="card-content"  style="height: 90px;"><h5 id="jam" class="center"></h5></div>
					</div>
				</div>
				<div class="col s2">
					<div class="card">
						<div class="card-content"  style="height: 90px;"><h5 id="menit" class="center"></h5></div>
					</div>
				</div>
				<div class="col s2">
					<div class="card">
						<div class="card-content"  style="height: 90px;"><h5 id="detik" class="center"></h5></div>
					</div>
				</div>
				<div class="col s4 md-2">
					<div class="card">
						<div class="card-content"  style="height: 90px;"><h5 id="textvote" class="center red-text">Ayo Vote!!</h5></div>
					</div>
				</div>
			</div>
			<?php }?>
		<div class="row">
			<div class="col s8">
		<?php 
		if(isset($daftar_pengumuman)){
		foreach ($daftar_pengumuman as $peng) {
			$judul = $peng['judul'];
			$deskripsi = $peng['deskripsi'];
			$waktu = $pengumuman[$peng['id_peng']];
			?> 
			
				<div class="card">
					<div class="card-content">
						<b><?php echo $judul;?></b></br>
						<span><?php echo $deskripsi;?></span></br></br>
						<span class="left grey-text"><?php echo $waktu;?>&nbsp;yang lalu</span></br>
					</div>
				</div>

	<?php	}}else{?>
			<div class="card">
					<div class="card-content">
						<?php echo "Tidak data tersedia..."?>
					</div>
				</div>
	<?php	}?>
	</div>
			<div class="col s4">
					<div class="card hoverable">
						<div class="card-content">
							<div class="row">
								<ul>
									<li><a href="<?php echo site_url('user/daftar_calon');?>" class="waves-effect waves-teal btn-flat col s12 center blue-text">Daftar Calon</a></li>
									<li><a href="<?php echo site_url('user/quickcount');?>" class="waves-effect waves-teal btn-flat col s12 center blue-text">Quick Count</a></li>
								</ul>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
			 <div class="fixed-action-btn horizontal click-to-toggle" style="margin-right: 200px; margin-bottom: 50px">
			    <a class="btn-floating btn-large red" href="#modal1">
			      <i class="material-icons ">menu</i>
			    </a>
	  		</div>

	  		<!-- Modal Structure -->
  <div id="modal1" class="modal hoverable">
    <div class="modal-content">
      <h4 class="blue-text">PNB E-VOTING</h4>
      <ul>
	      	<li>1. Voting akan aktif setelah tampil waktu didashboard kalian</li>
	      	<li>2. Jika terjadi masalah pada program segera laporkan ke panitia</li>
	      	<li>3. Jangan memilih lebih dari sekali, dilarang keras menggunakan bot atau apapun yang bersifat illegal</li>
      </ul>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
      <a href="#modal2" class=" modal-action  waves-effect waves-green btn-flat">LAPORKAN MASALAH!</a>
    </div>
  </div>
    <div id="modal2" class="modal hoverable">
    <div class="modal-content">
      <h4 class="blue-text">PNB E-VOTING</h4>
      	<div class="row">
		    <?php echo form_open('User/masalah');?>
			        <div class="row">
				        <div class="input-field col s12">
				          <textarea id="textarea1" class="materialize-textarea" name="deskripsi"></textarea>
				          <label for="textarea1">Deskripsi masalah</label>
				        </div> 
      				</div>
      				<div class="center">
      					<button type="submit" class="btn waves-effect waves-light #1976d2 blue darken-2">Submit</button>
      				</div>
			      </div>
		    <?php echo form_close();?>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>

	<script>

    CountDownTimer("<?php echo $end;?>", 'hari', 'jam', 'menit', 'detik');
    function CountDownTimer(dt, id1, id2, id3,id4)
    {
        var end = new Date(dt);

        var _second = 1000;
        var _minute = _second * 60;
        var _hour = _minute * 60;
        var _day = _hour * 24;
        var timer;

        function showRemaining() {
            var now = new Date();
            var distance = end - now;
            var distance1 = now - end;
            if(distance1 > 0){
            	document.getElementById(id).innerHTML = 'Voting Sudah Berakhir';
                clearInterval(timer);
                return;
            }
            var days = Math.floor(distance / _day);
            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);

            document.getElementById(id1).innerHTML = days + ' Hari';
            document.getElementById(id2).innerHTML = hours + ' Jam';
            document.getElementById(id3).innerHTML = minutes + ' Menit';
            document.getElementById(id4).innerHTML = seconds + ' Detik';
        }

        timer = setInterval(showRemaining, 1000);
    }

</script>
<script type="text/javascript">
var myVar = setInterval(myfun, 2000);

function myfun(){
   setTimeout(function(){$("#textvote").show(500)}, 1000);
   setTimeout(function(){$("#textvote").hide(500)}, 2000);
}
</script>
<script type="text/javascript">
	 $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
</script>
<?php include('Footer.php');?>