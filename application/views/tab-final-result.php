<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cout d'une piece de T-shirt</h1>
    <table border="1" >
        <tr>
            <td>Unite Oeuvre</td>
            <td><?php echo $resultCount->uniteOeuvre; ?></td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><?php echo $resultCount->nombre; ?></td>
        </tr>
        <?php for ($i=0; $i < count($resultCount->centreOperationnel) ; $i++) { ?>
            <tr>
                <td>Total <?php echo $resultCount->centreOperationnel[$i]->nom; ?></td>
                <td><?php echo $resultCount->centreOperationnel[$i]->getTotalCout(); ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td>Cout Totaux </td>
            <td><?php echo $resultCount->coutTotaux; ?></td>
        </tr>
        
    </table>
    <h3> Cout d'une Piece de T-Shirt </h3>
    <h4> <?php echo $resultCount->coutPiece; ?> </h4>
</body>
</html>