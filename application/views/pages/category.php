<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"><?= $title ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<a href="<?= base_url('category/new') ?>" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Category</a>
			</div>
		</div>
	</div>

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
							<?php if($_SESSION["logged_user"]["id"] === $cat->user_id) : ?>
									<a href="<?= base_url() ?>category/edit_category/<?= $cat->id_category ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                	<a href="javascript:goDelete(<?= $cat->id_category ?>)" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i>  </a>
								<?php else : ?>
									<button disabled type="button" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
									<button disabled type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
								<?php endif; ?>
                            </td>
						</tr>

				<?php endforeach; ?>	
			</tbody>
		</table>	
	<?php } else { ?>
			<div>No user(s) found.</div>
        <?php } ?>
		 		<?php if (isset($links)) { ?>			
					<?php echo $links ?>
				<?php } ?> 	
	</div>
</main>

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

  
