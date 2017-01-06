<?php include('Header.php');?>
<div class="container">
	<div class="row">
		<div class="card hoverable">
			<div class="card-panel">
				<span><a href="<?php echo site_url();?>">Home</a></span>
				> 
				<span>Pengumuman</span>
			</div>
		</div>
	</div>
<div class="row">

<div class="card-panel">
        <div class="row">
                      <div class="col s1 offset-s6"> <a class="waves-effect waves-light btn blue" style="width:20px; padding-left:10px; margin-top:10px" href="<?php echo site_url('Admin/vinsert_pengumuman')?>"><i class="small material-icons left white-text">add</i></a> </div>
                      <div class="col s4">
                        <?php echo form_open('Admin/search_pengumuman')?>
                            <input type="text" placeholder="Cari" name="search" value=""/>
                        <?php echo form_close()?>
                      </div>
                    </div>
                    
	<ul class="collapsible" data-collapsible="accordion">
<?php 
		if($data != null){
		foreach ($data as $pem) {
			$id = $pem->id_peng;
			$judul = $pem->judul;
			$des = $pem->deskripsi;
			$date = $pem->last_edited;
			$date_tampil = date('d M Y', strtotime($date)); 
			$time_tampil = date('h:i', strtotime($date)); 
			?>
			    <li>
			      <div class="collapsible-header active"><i class="material-icons">turned_in</i><?php echo "".$judul; ?>
			      	<span class="right"><?php echo "".$date_tampil; ?></span> </div>
			      	<div class="collapsible-body"><p><?php echo "".$des;  ?></p>
			      	<div class="row">
			      		<div class="col s8">
			      			<span class="left blue-text" style="margin-left: 20px"><?php echo "".$time_tampil; ?></span>
			      		</div>
			      		<div class="col s4">
				      		<span class="right"><?php echo anchor('Admin/edit_pengumuman?id='.$pem->id_peng, '<i class="small material-icons">mode_edit</i>', 'id="$id"');?>
	                       <a href="#"><i class="small material-icons blue-text" onclick="myFunction(<?php echo $id?>)">delete</i></a>
	                        </span>
	                     </div>
			      		
			      	</div>
			      	</div>
			    </li>
        
	<?php	}
}else{
	echo "There is no data loaded...";
}
	?>
	</ul>
			</div>
		</div>
 </div>
<script type="text/javascript">
	function myFunction(id) {
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
			url: "<?php echo base_url(); ?>"+"Admin/delete_pengumuman",
			dataType: 'json',
			data: {id:id},
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
					  window.location.href = "<?php echo site_url('Admin/daftar_pengumuman'); ?>";
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
<?php include('Footer.php');?>