<?php  include('Header.php');?>
<div class="container">
<div class="row">
	<div class="card hoverable">
		<div class="card-panel">
			<span><a href="<?php echo site_url();?>">Home</a></span>
			>
			<span>Data visi misi</span>
		</div>
	</div>
</div>
	<div class="row">
		<div class="card teal-text">
			<div class="card-content hoverable">
			<div class="row">
                      <div class="col s1 offset-s6"> <a class="waves-effect waves-light btn blue" style="width:20px; padding-left:10px; margin-top:10px" href="<?php echo site_url('admin/tambah_visimisi')?>"><i class="small material-icons left white-text">add</i></a> </div>
                      <div class="col s4">
                        <?php echo form_open('admin/search_user')?>
                            <input type="text" placeholder="Cari" name="search" value=""/>
                        <?php echo form_close()?>
                      </div>
                    </div>
				<ul class="collapsible" data-collapsible="accordion">
<?php 
		if($daftar_visimisi != null){
		foreach ($daftar_visimisi as $visimisi) {
			$no = $visimisi->no_kandidat;
			$visi = $visimisi->visi;
			$misi = $visimisi->misi;
			?>
			    <li>
			      <div class="collapsible-header active"><i class="material-icons">description</i><?php echo "".$no; ?></div>
			      	<div class="collapsible-body"><b><span style="margin-left: 10px">Visi</span></b><p><?php echo "".$visi;  ?></p>
			      	<b><span style="margin-left: 10px">Misi</span></b><p><?php echo "".$misi;  ?></p>
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
</div>
<script type="text/javascript">
	  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
</script>
<?php include('Footer.php');?>