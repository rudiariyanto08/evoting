<?php  include('Header.php');?>
<div class="container">
<div class="row">
	<div class="card hoverable">
		<div class="card-panel">
			<span><a href="<?php echo site_url();?>">Home</a></span>
			>
			<span>Data user</span>
		</div>
	</div>
</div>
<div class="row">
	<div class="card-panel hoverable">
        <div class="row">
                      <div class="col s1 offset-s6"> <a class="waves-effect waves-light btn blue" style="width:20px; padding-left:10px; margin-top:10px" href="<?php echo site_url('Admin/generate_code')?>"><i class="small material-icons left white-text">add</i></a> </div>
                      <div class="col s4">
                        <?php echo form_open('Admin/search_user')?>
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
		                              <th data-field="jurusan">Detail</th>
		                              <th data-field="jurusan">Delete</th>
		                          </tr>
		                        </thead>
		                        <tbody>
		                        <?php
		                        	if(!isset($no)){
		                        		$no=1;
		                        	}
		                        ?>
		                            <?php 
		                              foreach ($data as $data) {
		                                echo "<tr>";
		                                  echo "<td>$no</td>";
		                                  echo "<td>$data->nim</td>";
		                                  echo "<td>$data->nama</td>";
		                                  echo "<td>$data->jurusan</td>";?>
		                                  <td><?php echo anchor('admin/user_akun_detail?id='.$data->nim, '<i class="small material-icons">list</i>');?></td>
		                                  <td><a href="#"><i class="small material-icons blue-text"
		                                   onclick="myFunction(<?php echo $data->nim?>)">delete</i></a></td>
		                               <?php echo "</tr>";
		                                $no++;
		                              }
		                            ?>
		                        </tbody>
		                  </table> 

		                  <?php if(isset($pagination)){
		                  	echo $pagination;}?> 
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
			url: "<?php echo base_url(); ?>"+"admin/hapus_user",
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
					  window.location.href = "<?php echo site_url('admin/daftar_user'); ?>";
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