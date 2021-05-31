<?php 
	$this->load->view('templates/header');
	$this->load->view('templates/nav-top');

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Users</h1>
	</div>

	<div class="table-responsive">
	 <?php if (isset($users)) { ?>	
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Country</th>
				   <?php if($this->session->logged_user['nivel'] == 1) :?>
					<th>Nivel de acesso</th>
				   <?php endif; ?>	
				   <?php if($this->session->logged_user['nivel'] == 0) :?>
					<th>Editar Cadastro</th>
				   <?php endif; ?>	
				</tr>
			</thead>
			<tbody>
				<?php foreach($users as $user) : ?>
				  <?php if($this->session->logged_user['nivel'] == 1) :?>
						<tr>
							<td><?= $user->id ?></td>
							<td><?= $user->name ?></td>
							<td><?= $user->email ?></td>
							<td><?= $user->country ?></td>
							
							<td>			
						 		 	<?php if ($this->session->logged_user['id'] == 1) { ?> 
						 		 		   <a href="<?= base_url() ?>users/edit_user/<?= $user->id ?>"> <i class="fas fa-user-edit"></i> </a>
								  	<?php } else { ?>
										<?php if ($user->id > 1) : ?> 
						 		 		   <a href="<?= base_url() ?>users/edit_user/<?= $user->id ?>"> <i class="fas fa-user-edit"></i> </a>
								  		<?php endif; ?>
									<?php } ?>  
							</td>
						
						</tr>
				  <?php else: ?>
				  		<tr>
							<td><?= $user['id'] ?></td>
							<td><?= $user['name'] ?></td>
							<td><?= $user['email'] ?></td>
							<td><?= $user['country'] ?></td>
							<td>
								<a href="<?= base_url() ?>users/edit_user/<?= $user['id'] ?>"> <i class="fas fa-user-edit"></i> </a>
							</td>
						</tr>
				  <?php endif; ?>		
				  		
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

<?php
$this->load->view('templates/footer');
$this->load->view('templates/js');

?>
  
 