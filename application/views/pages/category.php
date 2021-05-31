<?php 
	$this->load->view('templates/header');
	$this->load->view('templates/nav-top');

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"><?= $title ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<a href="<?= base_url('category/new') ?>" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Category</a>
			</div>
		</div>
	</div>

	<?php if (validation_errors() != false) : ?>
		<div class="col-sm-3 alert alert-warning" role="alert">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>

	<div class="table-responsive">
	<?php if (isset($category)) { ?>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Category</th>
                    <th>Actions</th>
				</tr>
			</thead>
			<tbody>
                <?php foreach($category as $cat) : ?>
				  		<tr>		
							<td><?= $cat->id_category ?></td>
							<td><?= $cat->category ?></td>
                            <td>
							<?php if($this->session->logged_user["id"] === $cat->user_id) : ?>
									<a href="<?= base_url() ?>category/edit_category/<?= $cat->id_category ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
								  <!-- Checando e bloqueando o botâo delete se a categoria esta sendo usada em um jogo  -->	
								  <?php $check = $this->category_model->check_category($cat->id_category);
								  		if($check > 0 ) {?>	
										<button disabled type="button" class="btn btn-danger btn-sm" title="A categoria esta sendo utilizada!"><i class="fas fa-trash-alt"></i></a>
								  <?php } else { ?>
										<a href="javascript:goDelete(<?= $cat->id_category ?>)" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i>  </a>
								  <?php } ?>			
								<?php else : ?>
									<button disabled type="button" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt" title="Apenas quem inseriu pode editar!"></i></a>
									<button disabled type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt" title="Apenas quem inseriu pode excluir!"></i></a>
								<?php endif; ?>
                            </td>
						</tr>

				<?php endforeach; ?>	
			</tbody>
		</table>
		
	<?php } else { ?>
			<div class="d-flex justify-content-center">
					<h1>Você ainda não inseriu nenhum jogo</h1>
			</div>
        <?php } ?>
		 		<?php if (isset($links)) { ?>			
					<?php echo $links ?>
				<?php } ?> 	
	</div>
</main>

<?php
$this->load->view('templates/footer');
$this->load->view('templates/js');

?>



<script>
	
	function goDelete(id) {
	
	
			if(confirm("Deseja apagar esta categoria?")) {
				window.location.href = 'category/delete/'+id;
			} else {
				alert("A categoria não foi excluida");
				return false;
			}
	
	}
</script>

  
