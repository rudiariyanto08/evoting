</main>
<footer class="page-footer #1976d2 blue darken-2 main">
		<div class="footer-copyright ">
			<div class="container">
				<a class="grey-text text-lighten-4 right" href="http://balidev.top">Copyright ManInback</a>
			</div>
		</div>
</footer>
<?php if($this->session->flashdata('messageTitle')!=''):?>
<script>
	window.onload = function(){
		swal({
			title: "<?php echo $this->session->flashdata('messageTitle'); ?>",
			text: "<?php echo $this->session->flashdata('message'); ?>",
			showConfirmButton: true,
			confirmButtonColor: '#0760ef',
			type:"<?php echo $this->session->flashdata('messageType'); ?>"
		})
	};
</script>
<?php endif; ?>
</body>
</html>