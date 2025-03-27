<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recette</title>
</head>
<body>
    <?php
    try{
        $mysqlClient = new PDO(
            'mysql:host=localhost;dbname=recette;charset=utf8',
            'root',
            ''
        );
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }

  
    $sqlQuery = 'SELECT * FROM recette WHERE temps_de_preparation >= :time' ;

    $recipesStatement = $mysqlClient->prepare($sqlQuery);
    $recipesStatement->execute([
    'time' => 10
    ]);
    $recipes = $recipesStatement->fetchAll();

    foreach ($recipes as $recipe){
    ?>
        <p><?php echo $recipe['nom_recette'] ?></p>
    <?php
    }
    

    ?>
</body>
</html>