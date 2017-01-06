<?php include('Header.php');?>
<?php 
	$no = $no_calon['no_kandidat'];
	?>
	<div class="container">
		<div class="row">
			<?php 
				for($i=1; $i<=$no; $i++){
					$vote = $suara[$i];
					?>
						<div class="col s4 ">
							<div class="card valign-wrapper">
							<h1 class="col s7"><?php echo $vote;?></h1>
							</div>
						</div>
					</a>
					<?php
				}
			?>
		</div>
		<div class="row">
			<div class="col s12 center">
				<a class="btn waves-effect waves-light #1976d2 blue darken-2 " href="<?php echo site_url('Admin/reset');?>">RESET</a>
			</div>
		</div>
	</div>
<?php include('Footer.php');?>