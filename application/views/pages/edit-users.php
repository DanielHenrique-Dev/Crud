<?php 
	$this->load->view('templates/header');
	$this->load->view('templates/nav-top');

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $title ?></h1>
      </div>

			<div class="col-md-12">
			
			<?php if(validation_errors() != false) : ?>
				<div class="col-sm-3 alert alert-warning" role = "alert">
					<?php echo validation_errors(); ?>
				</div>
			<?php endif; ?>

	    
			<?php	$id = $user["id"] ?>
			<?php	$url = "users/edit_user/" . $id ?>
			<?php echo form_open($url); ?>

			<?php 
					if($id == 1 && $id != $this->session->logged_user['id'])
					{
						redirect('users');
					}
			
			?>

			
					<div class="col-md-4">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= isset($user['name']) ? set_value('name',$user['name']) : set_value('name')  ?>">
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" class="form-control" name="email" id="email" placeholder="email" value=" <?= isset($user['email']) ? set_value('email',$user['email']) : set_value('email') ?>">
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="country">Country</label>
							<input type="country" class="form-control" name="country" id="country" placeholder="country" value="<?= isset($user['country']) ? $user['country'] : '' ?>">
						</div>
					</div>

					
						<div class="row col-md-12">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="password" >Senha</label>
									<input type="password" class="form-control" name="password" id="password" placeholder="senha" value="<?= isset($user['password']) ? $user['password'] : '' ?>">
								</div>
							</div>
						</div>
				

				    	
							<div class="col-md-4">
								<div class="form-group">
									<label >Nivel</label>
									<select class="form-control" name="nivel">
										<option  value="1" <?=($user['nivel'] == 1)?'selected':''?> >Administrador</option>
										<option value="0" <?=($user['nivel'] == 0)?'selected':''?> >Usuário</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Ativo</label>
									<select class="form-control" name="ativo">
										<option value="1" <?=($user['ativo'] == 1)?'selected':''?> >Ativo</option>
										<option value="0" <?=($user['ativo'] == 0)?'selected':''?> >Desativar</option>
									</select>
								</div>
							</div>
					

					<div class="col-md-6">
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>users" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
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
