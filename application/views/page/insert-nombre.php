<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url("assets/img/apple-icon.png"); ?>">
  <link rel="icon" type="image/png" href="<?php echo base_url("assets/img/favicon.png") ?>">
  <!-- titre -->
  <title>
    Lamba
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?php echo base_url("assets/css/nucleo-icons.css") ?>" rel="stylesheet" />
  <link href="<?php echo base_url("assets/css/nucleo-svg.css") ?>" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?php echo base_url("assets/css/nucleo-svg.css") ?>" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?php echo base_url("assets/css/soft-ui-dashboard.css?v=1.0.3") ?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css") ?>">
</head>

<body class="g-sidenav-show  bg-gray-100 col-md-12" >

  <!-- navigation -->
  <?php $this->load->view("includes/sideBar.php"); ?>  
  <!-- corp -->
  <div style="height:100px"></div>
  <main  class="position-relative max-height-vh-100 h-100 mt-1 border-radius-lg offset-md-3 col-md-9" style="">

    <div class="row"  >
    <!-- div du conten -->
      <div style="background-color:white;align-items:center;justify-content:center;border-radius:12px; padding:17px 15px;" class="col-md-5" >
        <h3 class="font-weight-bolder text-info text-gradient offset-md-2" style="align-self: center;">Seuil de rentabilite</h3>
        <form action="<?php echo site_url("resultController/getResultat"); ?>" method="get" >
          <label class="offset-md-1">Nombre</label>
          <div class="offset-md-1 col-md-10">
            <input type="number" class="form-control" name="nombre" aria-label="Email" aria-describedby="email-addon">
          </div>

          <label class="offset-md-1">Marge</label>
          <div class="offset-md-1 col-md-10">
            <input type="number" name="marge" class="form-control"  placeholder="Marge de benefice" aria-label="Email" aria-describedby="email-addon">
          </div>

          <div class="text-center offset-md-2 col-md-8">
            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Valider</button>
          </div>
        </form>
      </div>

      <!-- contenu 2 : centre -->
      

    <!-- fin div du contenu -->
    </div>
 </main>


  <!--   Core JS Files   -->
  <?php $this->load->view("includes/footer.php"); ?>
</body>

</html>
