<?php  include('Header.php');?>

<div class="container" style="margin-top: 75px">
	<div class="row">
		<div class="col s4">
			<div class="card hoverable">
				<div class="card-image waves-effect waves-block waves-light center activator">
					<i class="material-icons large activator red-text" style="padding-top: 70px;">description</i>
				</div>
				<div class="card-content">
				     <span class="card-title activator grey-text text-darken-4">Pengumuman<i class="material-icons right" style="padding-top: 10px">more_vert</i></span>
			    </div>
			    <div class="card-reveal">
				    <span class="card-title grey-text text-darken-4">Pengumuman<i class="material-icons right red-text">close</i></span>
				    <a href="<?php echo site_url('Admin/daftar_pengumuman')?>">Daftar Pengumuman</a>
				    <p><a href="<?php echo site_url('Admin/vinsert_pengumuman')?>">Tambah</a></p>
			    </div>
			</div>
		</div>

		<div class="col s4">
			<div class="card hoverable">
				<div class="card-image waves-effect waves-block waves-light center activator">
					<i class="material-icons large activator red-text" style="padding-top: 70px;">face</i>
				</div>
				<div class="card-content">
				     <span class="card-title activator grey-text text-darken-4">Calon Presma<i class="material-icons right" style="padding-top: 10px">more_vert</i></span>
			    </div>
			    <div class="card-reveal">
				    <span class="card-title grey-text text-darken-4">Calon Presma<i class="material-icons right red-text">close</i></span>
				    <p><a href="<?php echo site_url('Admin/vkandidat')?>">Data Kandidat</a></p>
				    <p><a href="<?php echo site_url('Admin/visimisi')?>">Data Visi Misi</a></p>
				    <p><a href="<?php echo site_url('Admin/vdaftar_kandidat')?>">Tambah Kandidat</a></p>
				    <p><a href="<?php echo site_url('Admin/quickqount')?>">Quick Count</a></p>
			    </div>
			</div>
		</div>

		<div class="col s4">
			<div class="card hoverable">
				<div class="card-image waves-effect waves-block waves-light center activator">
					<i class="material-icons large activator red-text" style="padding-top: 70px;">account_balance</i>
				</div>
				<div class="card-content">
				     <span class="card-title activator grey-text text-darken-4">User<i class="material-icons right" style="padding-top: 10px">more_vert</i></span>
			    </div>
			    <div class="card-reveal">
				    <span class="card-title grey-text text-darken-4">User<i class="material-icons right red-text">close</i></span>
				    <p><a href="<?php echo site_url('Admin/daftar_user')?>">Daftar User</a></p>
				    <p><a href="<?php echo site_url('Admin/generate_code')?>">Generate Code</a></p>
			    </div>
			</div>
		</div>
	</div>
</div>	

<?php include('Footer.php');?>