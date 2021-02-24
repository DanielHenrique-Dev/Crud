<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?= base_url()?>dashboard">Games 4 Devs</a>
	<div>

    <?php
          $urlm2 = base_url('dashboard/pesquisar_mygames');
          $urlm = base_url('mygames/mygames_listar');
          $urld = base_url('dashboard');
          $urlg = base_url('games');
          $urlg2 = base_url('dashboard/pesquisar');  
          $urlc = base_url('category');
          $urlc2 = base_url('dashboard/pesquisar_category'); 
          $urlAtt = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
    ?>

    <?php if($urlg == $urlAtt || $urlg2 == $urlAtt ) { ?>
      <?= form_open('dashboard/pesquisar'); ?>
    <?php } elseif ($urlc == $urlAtt || $urlc2 == $urlAtt) { ?>  
      <?= form_open('dashboard/pesquisar_category'); ?>  
    <?php } elseif ($urlm == $urlAtt || $urlm2 == $urlAtt) { ?>
      <?= form_open('dashboard/pesquisar_mygames'); ?>      
    <?php } else { ?>  
      <?= form_open('dashboard/pesquisar_usuario'); ?>
    <?php } ?>
      <?php if ($urld != $urlAtt) { ?>
		  	<input class="form-control form-control-dark" type="text" name="busca" id="busca" placeholder="Search" aria-label="Search" value="">
      <?php } ?>  
		<?= form_close(); ?>
	</div>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="<?= base_url() ?>login/logout">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Menu</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>dashboard">
              <span data-feather="file"></span>
              Dashboard
            </a>
          </li>
					<li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>games">
              <span data-feather="file"></span>
              Games
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>users">
              <span data-feather="shopping-cart"></span>
              Users
            </a>
					</li>
					<li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>mygames/mygames_listar">
              <span data-feather="shopping-cart"></span>
              My Games
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>category">
              <span data-feather="shopping-cart"></span>
              Category
            </a>
          </li>
        </ul>
      </div>
    </nav>
