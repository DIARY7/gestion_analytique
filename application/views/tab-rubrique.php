<?php 
    echo "<pre>";
    var_dump($tabRubrique[4]->secteur);
    echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <th rowspan="2">Rubriques</th>
            <th rowspan="2" >Total</th>
            <th rowspan="2" >Unite d'oeuvre</th>
            <th rowspan="2" >Nature</th>
            <?php for ($i=0; $i < count($secteurs) ; $i++) { ?> 
                <th colspan="3"> <?php echo $secteurs[$i]["nomination"]; ?> 
                </th>
                
            <?php } ?>
        </tr>
        <tr>
        <?php for ($i=0; $i < count($secteurs) ; $i++) { ?> 
                <th> % </th>
                <th>Fixe</th>
                <th>Variable</th>
            <?php } ?>
        </tr>
        <?php 
            foreach ($tabRubrique as $rubSect) { ?>
                <tr>
                    <td><?php echo $rubSect->rubrique["nom"]; ?></td>
                    <td><?php echo $rubSect->rubrique["total"]; ?></td>
                    <td><?php echo $rubSect->rubrique["uniteOeuvre"]; ?></td>
                    <td><?php echo $rubSect->rubrique["nomNature"]; ?></td>
                    
                </tr>
            <?php } ?>
    </table>
</body>
</html>