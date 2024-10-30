<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
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
  <style>

  </style>
	<script>

		function validatePercent() {
			let total = 0;
			const percentInputs = document.querySelectorAll('.pourcentage');

			// Calculer la somme des pourcentages
			percentInputs.forEach(input => {
				let value = parseFloat(input.value);
				if (!isNaN(value)) {
					total += value;
				}
			});

			// Vérifier si la somme des pourcentages est égale à 100
			if (total > 100) {
				alert("Le total des pourcentages ne peut pas dépasser 100%.");
				return false;
			} else if (total < 100) {
				alert("Le total des pourcentages doit être égal à 100%.");
				return false;
			}

			// Si la validation est correcte, le formulaire peut être soumis
			return true;
		}

		// Ajouter un écouteur d'événement pour la soumission du formulaire
		// document.querySelector('form').addEventListener('submit', function(event) {
		// 	if (!validatePercent()) {
		// 		event.preventDefault(); // Empêcher la soumission si la validation échoue
		// 	}
		// });
	</script>
</head>

<body class="g-sidenav-show  bg-gray-100 col-md-12" >

  <!-- navigation -->
  <?php $this->load->view("includes/sideBar.php"); ?>  
  <!-- corp -->
  <div style="height:100px"></div>
  <main class="position-relative max-height-vh-100 h-100 mt-1 border-radius-lg offset-md-3 col-md-9" style="">

    <div class="row">
    <!-- div du conten -->
    <form action="<?php echo site_url("RubriqueController/insertRubrique"); ?>" style="display:flex;" method="POST" >
      <div style="background-color:white;align-items:center;justify-content:center;border-radius:12px;padding:17px 15px;" class="col-md-5" >
        <h3 class="font-weight-bolder text-info text-gradient offset-md-2" style="align-self: center;">insertion de charge</h3>
        
          <label class="offset-md-1">Rubriques</label>
          <div class="offset-md-1 col-md-10">
            <input type="text" name="nom" class="form-control" placeholder="rubriques" aria-label="Email" aria-describedby="email-addon">
          </div>

          <label class="offset-md-1">Unite oeuvre</label>
          <div class="offset-md-1 col-md-10">
            <input type="text" name="uniteOeuvre" class="form-control" placeholder="Unite d'oeuvre" aria-label="Email" aria-describedby="email-addon">
          </div>

          <!-- nature -->
          <label class="offset-md-1">natures</label>
          <div class="offset-md-1 col-md-10">

            <select name="idNature" id="" class="form-select">
              <?php for ($i=0; $i < count($natures) ; $i++) { ?> 
                <option value="<?php echo $natures[$i]["idNature"]; ?>"><?php echo $natures[$i]["nomination"]; ?></option>  
              <?php } ?>
            </select>
          </div>
          <!-- devis -->
          <label class="offset-md-1">Total</label>
          <div class="offset-md-1 col-md-10">
            <input type="number" name="total" class="form-control" placeholder="deivs du charge" aria-label="Email" aria-describedby="email-addon">
          </div>

          <div class="text-center offset-md-2 col-md-8">
            <button type="submit" id="valider" class="btn bg-gradient-info w-100 mt-4 mb-0">Valider</button>
          </div>
					<p id="error_percent" style="color:red;display:none;">La somme des pourcentages doit être =0 ou =100%</p>
        <!-- </form> -->
      </div>

      <!-- contenu 2 : centre -->
      <div style="background-color:white;align-items:center;justify-content:center;border-radius:12px;padding-bottom:12px;padding:17px 15px;" class=" offset-md-1 col-md-6 column" >
        <h3 class="font-weight-bolder text-info text-gradient offset-md-2" style="align-self: center;">Centre</h3>
        <!-- <form action="" class="row">  -->
          <div class="row">
          <div class="col-md-6">
            <?php for ($i=0; $i < count($secteurs) ; $i++) { ?> 
                <label class="offset-md-1"><?php echo $secteurs[$i]["nomination"]; ?></label>
                <input type="checkbox" name="check<?php echo  $secteurs[$i]["idSecteur"]; ?>" id="" value="<?php echo $secteurs[$i]["idSecteur"]; ?>">
                <div class="offset-md-1 col-md-9">
                  <input type="number" class="form-control percent<?php echo $i; ?>" id="percent<?php echo $secteurs[$i]["idSecteur"]; ?>" name="percent<?php echo  $secteurs[$i]["idSecteur"]; ?>" placeholder="pourcentage" aria-label="Email" aria-describedby="email-addon">
                </div>  
            <?php } ?>
            
          </div>
          </div>
        </form>
      </div>

    <!-- fin div du contenu -->
    </div>
 </main>


  



  <!--   Core JS Files   -->
  <script src="<?php echo base_url("") ?>../assets/js/core/popper.min.js"></script>
  <script src="<?php echo base_url("") ?>../assets/js/core/bootstrap.min.js"></script>
  <script src="<?php echo base_url("") ?>../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?php echo base_url("") ?>../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url("") ?>../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
  <?php if ($ok===false) { ?>
      <script> alert("Insertion echouer") </script>
  <?php } else if($ok===true){ ?>
    <script> alert("Insertion reussi👌") </script>
  <?php } ?>

	<script>
		var countSecteur = <?php echo count($secteurs); ?>;
		var btnValider = document.getElementById("valider");
		var para_error = document.getElementById("error_percent");
		
		for (let index = 0; index < countSecteur; index++) {
			document.querySelector(".percent"+index).addEventListener("input",checkPercent)
		}
		function checkPercent () {
			let sum = 0;
			for (let index = 0; index < countSecteur; index++) {
				sum+= Number(document.querySelector(".percent"+index).value);
			}
			if ((sum<100 && sum>0) || sum>100 ) {
				btnValider.disabled =true;
				btnValider.style='opacity:0.3';
				para_error.style = `display: block; color: red; font-size: 13px;`;
			}
			else{
				btnValider.disabled =false;
				btnValider.style='opacity:1';
				para_error.style = "display:none";
			}	
		}
			
	</script>
</body>

</html>
