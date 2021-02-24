<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.6">
  <title><?= $title ?></title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">

  <!-- Bootstrap core CSS -->
  <link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <meta name="theme-color" content="#563d7c">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="https://getbootstrap.com/docs/4.4/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="container justify-content-md-center text-center">



  <?php echo form_open('signup/index'); ?>

  <?php if (validation_errors() != false) : ?>
    <div class="mb-4 alert-warning" role="alert">
      <?php echo validation_errors(); ?>
    </div>
  <?php endif; ?>

  <img class="mb-4" src="https://getbootstrap.com/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>


  <label for="name" class="mb-4 sr-only">Name</label>
  <input type="text" name="name" id="name" class="form-control mb" placeholder="Your Name" autofocus>


  <label for="country" class="mb-4 sr-only">Country</label>
  <input type="text" name="country" id="country" class="form-control" placeholder="Country" autofocus>

  <label for="email" class="mb-4 sr-only">Email address</label>
  <input type="email" name="email" id="email" class="form-control" placeholder="Email address" autofocus>

  <label for="password" class="mb-4 sr-only">Password</label>
  <input type="password" name="password" id="password" class="form-control" placeholder="Password">

  <p>
    <a href="<?= base_url() ?>login">Already Have an Account?</a>
  </p>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
  <?php echo form_close(); ?>

</body>

</html>