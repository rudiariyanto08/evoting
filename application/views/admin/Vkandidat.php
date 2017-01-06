<?php  include('Header.php');?>
<div class="container">
<div class="row">
	<div class="card hoverable">
		<div class="card-panel">
			<span><a href="<?php echo site_url();?>">Home</a></span>
			>
			<span>data kandidat</span>
		</div>
	</div>
</div>
<div class="row">
	<div class="card-panel hoverable">		
        <div class="row">
                      <div class="col s1 offset-s6"> <a class="waves-effect waves-light btn blue" style="width:20px; padding-left:10px; margin-top:10px" href="<?php echo site_url('admin/vdaftar_kandidat')?>"><i class="small material-icons left white-text">add</i></a> </div>
                      <div class="col s4">
                        <?php echo form_open('admin/search_kandidat')?>
                            <input type="text" placeholder="Cari" name="search" value=""/>
                        <?php echo form_close()?>
                      </div>
                    </div>
	<div class="row">
		<div class="col s10 offset-s1">
					 <div class="row">
		              <div class="col s10 offset-s1">
		                  <table>
		                        <thead>
		                          <tr>
		                              <th data-field="no">No</th>
		                              <th data-field="nim">NIM</th>
		                              <th data-field="Nama">Nama</th>
		                              <th data-field="jurusan">Jurusan</th>
		                              <th data-field="jurusan">No Kandidat</th>
		                              <th data-field="jurusan">Detail</th>
		                              <th data-field="jurusan">Delete</th>
		                          </tr>
		                        </thead>
		                        <tbody>
		                            <?php 
		                            $no = 1;
		                              foreach ($daftar_kandidat as $kandidat) {
		                                echo "<tr>";
		                                  echo "<td>$no</td>";
		                                  echo "<td>$kandidat->nim</td>";
		                                  echo "<td>$kandidat->nama</td>";
		                                  echo "<td>$kandidat->jurusan</td>";
		                                  echo "<td>$kandidat->no_kandidat</td>";?>
		                                  <td><?php echo anchor('admin/detail_kandidat?id='.$kandidat->nim, '<i class="small material-icons">list</i>');?></td>
		                                  <td><a href="#"><i class="small material-icons blue-text"
		                                   onclick="myFunction(<?php echo $kandidat->nim?>)">delete</i></a></td>
		                               <?php echo "</tr>";
		                                $no++;
		                              }
		                            ?>
		                        </tbody>
		                  </table> 
		              </div>
		            </div>
				</div>
			</div>
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
			url: "<?php echo base_url(); ?>"+"admin/hapus_kandidat",
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
					  window.location.href = "<?php echo site_url('admin/vkandidat'); ?>";
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