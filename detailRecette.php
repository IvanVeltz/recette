<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Recette</title>
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


    // On recupere les infos de la recette passé à l'url
    $sqlQuery = 'SELECT r.nom_recette, c.nom_categorie, r.temps_de_preparation 
                    FROM recette r
                    INNER JOIN categorie c ON c.id_categorie = r.id_categorie
                    WHERE id_recette = :id' ;

    $recipesStatement = $mysqlClient->prepare($sqlQuery);
    $recipesStatement->execute([
        'id' => $_GET['id']
    ]);
    $recipe = $recipesStatement->fetch();

    echo ("
                <h2>$recipe[nom_recette]</h2>
                <p>Catégorie : $recipe[nom_categorie]</p>
                <p>Temps de preparation : $recipe[temps_de_preparation] minutes</p>
            ");
    

    $sqlQuery = 'SELECT i.nom_ingredient
                    FROM ingredient i
                    INNER JOIN contenir co ON co.id_ingredient = i.id_ingredient
                    WHERE co.id_recette = :id';
    $recipesStatement = $mysqlClient->prepare($sqlQuery);
    $recipesStatement->execute([
        'id' => $_GET['id']
    ]);
    $ingredients = $recipesStatement->fetchAll();

    ?>
    <p>Liste des ingredients :</p>
    <ul>
    <?php
    foreach ($ingredients as $ingredient){
        echo ("<li>$ingredient[nom_ingredient] </li>");
    }
    ?>
    </ul>
</body>
</html>