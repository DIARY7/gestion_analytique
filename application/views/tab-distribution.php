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
            <th>REPARTITION <?php echo $repartition->centreOrg->nom; ?></th>
            <th>Cout direct</th>
            <th>cles</th>
            <th><?php echo $repartition->centreOrg->nom; ?></th>
            <th>Cout total</th>
        </tr>
        <?php for ($i=0; $i < count($repartition->centreOperationnel) ; $i++) { ?>
            <tr>
                <td>Total <?php echo $repartition->centreOperationnel[$i]->nom; ?></td>
                <td> <?php echo  $repartition->centreOperationnel[$i]->getTotalCout(); ?> </td>
                <td>  </td>
                <td><?php echo $repartition->distribution[$i]; ?></td>
                <td><?php echo $repartition->coutTotal[$i]; ?></td>
            </tr>            
        <?php } ?>
        <tr>
            <td>Total General</td>
            <td><?php echo $repartition->getTotalCoutDirect(); ?></td>
            <td></td>
            <td><?php echo $repartition->getTotalDistribution(); ?></td>
            <td><?php echo $repartition->getTotalCoutTotal(); ?></td>
        </tr>
    </table>
</body>
</html>