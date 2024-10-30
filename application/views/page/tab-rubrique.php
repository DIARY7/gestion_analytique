<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url("assets/img/apple-icon.png"); ?>">
  <link rel="icon" type="image/png" href="<?php echo base_url("/assets/img/favicon.png"); ?>">
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
    <meta charset="UTF-8">
    <title>Tableau des Rubriques</title>
    <style>
        table {
            border-collapse: collapse;
            /* width: 100%; */
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
            font-size:13px;
        }
        th {
            background-color: #f2f2f2;
        } 
        .titreTab{
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            z-index: 1;

            background-image: linear-gradient(310deg, #2152FF, #21D4FD);
        }
        aside{
            background-color:white;
        }
    </style>
</head>
<body>
    <!-- navigation -->
    <?php $this->load->view("includes/sideBar.php"); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <h2 class="titreTab" >Tableau des Rubriques</h1>
    <table>
        <tr>
            <th rowspan="2">Rubriques</th>
            <th rowspan="2">Total</th>
            <th rowspan="2">Unité d'œuvre</th>
            <th rowspan="2">Nature</th>
            <?php for ($i = 0; $i < count($secteurs); $i++) { ?> 
                <th colspan="3"><?php echo $secteurs[$i]["nomination"]; ?></th>
            <?php } ?>
            <th colspan="3">Total</th>
        </tr>
        <tr>
            <?php for ($i = 0; $i < count($secteurs); $i++) { ?> 
                <th>%</th>
                <th>Fixe</th>
                <th>Variable</th>
            <?php } ?>
            <th>Fixe</th>
            <th>Variable</th>
        </tr>

        <!-- Ligne pour chaque rubrique -->
        <?php foreach ($tabRubrique as $rubSect) { ?>
            <tr>
                <td><?php echo $rubSect->rubrique["nom"]; ?></td>
                <td><?php echo number_format($rubSect->rubrique["total"]); ?></td>
                <td><?php echo $rubSect->rubrique["uniteOeuvre"]; ?></td>
                <td><?php echo $rubSect->rubrique["nomNature"]; ?></td>
                
                <?php 
                // Variables pour les totaux fixes et variables
                $sommeFixe = 0;
                $sommeVariable = 0;

                foreach ($secteurs as $secteur) {
                    $corresponding_rubsecteur = null;
                    foreach ($rubsecteurs as $rubsecteur) {
                        if ($rubsecteur->idSecteur == $secteur["idSecteur"] && $rubsecteur->idRubrique == $rubSect->rubrique["idRubrique"]) {
                            $corresponding_rubsecteur = $rubsecteur;
                            break;
                        }
                    }
                    
                    if ($corresponding_rubsecteur) {
                        echo '<td>' . $corresponding_rubsecteur->pourcentage . '</td>';
                        
                        if ($corresponding_rubsecteur->idNature == 1) { 
                            // Si c'est variable
                            echo '<td>0</td>';
                            echo '<td>' .number_format($corresponding_rubsecteur->cout)  . '</td>'; 
                            $sommeVariable += $corresponding_rubsecteur->cout;
                        } elseif ($corresponding_rubsecteur->idNature == 2) { 
                            // Si c'est fixe
                            echo '<td>' . number_format($corresponding_rubsecteur->cout)  . '</td>';
                            echo '<td>0</td>';
                            $sommeFixe += $corresponding_rubsecteur->cout;
                        }
                    } else {
                        echo '<td></td><td></td><td></td>';
                    }
                } ?>

                <!-- Remplacement de FDFFFG par la somme des coûts fixes et variables -->
                <td><?php echo number_format($sommeFixe); ?></td>
                <td><?php echo number_format($sommeVariable); ?></td>
            </tr>
        <?php } ?>

        <!-- Ligne des totaux des rubriques -->
        <tr>
            <th>Total des rubriques</th>
            <th colspan="3"><?php echo( number_format($totalRubrique)); ?></th>
            
            <?php 
            // Initialiser des totaux pour les coûts fixes et variables
            $totalCoutFixe = array_fill(0, count($secteurs), 0);
            $totalCoutVariable = array_fill(0, count($secteurs), 0);
            
            // Remplir les totaux
            foreach ($coutParNature as $cout) {
                $secteurIndex = array_search($cout['secteur'], array_column($secteurs, 'nomination'));
                if ($secteurIndex !== false) {
                    if ($cout['nature'] === 'Fixe') {
                        $totalCoutFixe[$secteurIndex] += $cout['cout'];
                    } elseif ($cout['nature'] === 'Variable') {
                        $totalCoutVariable[$secteurIndex] += $cout['cout'];
                    }
                }
            }

            // Afficher les totaux pour chaque secteur
            for ($i = 0; $i < count($secteurs); $i++) { ?>
                <td></td> <!-- Pourcentage Total -->
                <td><?php echo number_format($totalCoutFixe[$i]); ?></td>
                <td><?php echo number_format($totalCoutVariable[$i]); ?></td>
            <?php } ?>
            <td><?php echo number_format(array_sum($totalCoutFixe)); ?></td>
            <td><?php echo number_format(array_sum($totalCoutVariable)); ?></td>
        </tr>

        <!-- Ligne des totaux par centre -->
        <tr>
            <th colspan="4">Total par centre</th>
            <?php foreach ($coutTotalSecteur as $parsect) { ?>
                <th colspan="3"><?php echo number_format($parsect['cout']); ?></th>
            <?php } ?>
            <td colspan="2"><?php echo number_format($coutTotalFV) ; ?></td>
			
		</tr>
    </table>
    </main>
</body>
</html>
