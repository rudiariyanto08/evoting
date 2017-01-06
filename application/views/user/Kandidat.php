<?php include('Header.php');?>
<?php 
	$no = $no_calon['no_kandidat'];
	?>
	<div class="container">
		<div class="row">
			<?php 
				for($i=1; $i<=$no; $i++){
					?>
					<a href="<?php echo site_url('user/detail_kandidat')?>/<?php echo $i;?>">
						<div class="col s4 ">
							<div class="card valign-wrapper">
							<h1 class="col s7"><?php echo $i;?></h1>
							</div>
						</div>
					</a>
					<?php
				}
			?>
		</div>
	</div>
<?php include('Footer.php');?>
