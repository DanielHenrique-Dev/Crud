<?php
$this->load->view('templates/header');
$this->load->view('templates/nav-top');

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"><?= $title ?></h1>
	</div>

	<div class="col-md-12">

		<?php if (validation_errors() != false) : ?>
			<div class="col-sm-3 alert alert-warning" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>

		<?php
		if (isset($cat)) {
			$id = $cat["id_category"];
			$url = "category/edit_category/" . $id;

			echo form_open($url);

			//checando id
			$id_user_log = $this->session->logged_user['id'];
			if ($id_user_log != $cat['user_id']) {
				redirect('category');
			}
		} else {
			echo form_open("category/new");
		}
		?>
		
		<div class="col-md-4">
			<div class="form-group">
				<label for="category">Categoria</label>
				<input type="text" class="form-control" name="category" id="category" placeholder="Categoria" value="<?= isset($cat['category']) ? set_value('category', $cat['category']) : set_value('category')  ?>">
			</div>
		</div>

		<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
		<a href="<?= base_url() ?>category" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
	</div>
	</div>
	<?php echo form_close(); ?>
	</div>

</main>
</div>
</div>

<?php
$this->load->view('templates/footer');
$this->load->view('templates/js');

?>