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

	    
	    <!-- game é esta no models -->
		<?php if(isset($game)) { ?>			
		<?php	$id = $game["id"] ?>
		<?php	$url = "games/edit/" . $id ?>	
			 <?php echo form_open($url); ?>	
		<?php } else { ?>
			 <?php echo form_open("games/new"); ?>
		<?php } ?>	 			

					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= isset($game["name"]) ? set_value('name',$game["name"]) : set_value('name') ?>" >
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="description">Description</label>
							<textarea name="description" id="description" rows="5" class="form-control" ><?= isset($game["description"]) ? set_value('description',$game["description"]) : set_value('description') ?></textarea>
						</div>
					</div>

					<div class="col-md-6">
						<div>							
							<label for="category">Categoria</label>
   							<?php echo form_dropdown('Category_id', $category, array(),'class="form-control"' );?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="price">Price</label>
							<input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?= isset($game["price"]) ? set_value('price',$game["price"]) : set_value('price') ?>" >
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="developer">Developer</label>
							<input type="text" class="form-control" name="developer" id="developer" placeholder="Developer" value="<?= isset($game["developer"]) ? set_value('developer',$game["developer"]) : set_value('developer') ?>" >
						</div>
					</div>

					<div class="col-md-6">
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>dashboard" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>

    </main>
  </div>
</div>
