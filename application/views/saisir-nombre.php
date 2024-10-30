<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>SAISIR LE NOMBRE de T-shirt</h1>
    <form action="<?php echo site_url('ResultController/getResultat') ?>" method="post">
        <input type="number" name="nombre" id="">
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>