<?php include('Header.php');?>
<div class="container">
<div class="row">
	<div class="card hoverable">
		<div class="card-panel">
			<span><a href="<?php echo site_url();?>">Home</a></span>
			>
			<span>Data Pesan User</span>
		</div>
	</div>
</div>
	<div class="row">
		<div class="card teal-text">
			<div class="card-content hoverable">
				<ul class="collapsible" data-collapsible="accordion">
<?php 
		if($data != null){
		foreach ($data as $data) {
			$nim = $data->nim;
			$desk = $data->deskripsi;
			?>
			    <li>
			      <div class="collapsible-header active"><i class="material-icons">description</i>From : <?php echo "".$nim; ?></div>
			      	<div class="collapsible-body"><b><span style="margin-left: 10px">Deskripsi : </span></b><p><?php echo "".$desk;  ?></p>
			      	</div>
			    </li>
        
	<?php	}
}else{
	echo "There is no data loaded...";
}
	?>
	</ul>
			<?php if(isset($pagination)){
		                  	echo $pagination;}?> 
			</div>
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