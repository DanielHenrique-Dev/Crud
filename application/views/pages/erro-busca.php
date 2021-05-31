<?php 
	$this->load->view('templates/header');
	$this->load->view('templates/nav-top');

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<?php if (validation_errors() != false) : ?>
			<div class="col-sm-3 alert alert-warning" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>
	
	</div>

	<h1><strong>Falha na Busca</strong></h1>
</main>

<?php
$this->load->view('templates/footer');
$this->load->view('templates/js');

?>
  
 