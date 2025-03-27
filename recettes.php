<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recette</title>
</head>
<body>
    <table>
        <caption>Liste des recettes</caption>
        <thead>
            <tr>
                <td>Nom de la recette</td>
                <td>Catégorie</td>
                <td>Temps de préparation</td>
            </tr>
        </thead>
        <tbody>
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

  
    $sqlQuery = 'SELECT r.id_recette, r.nom_recette, c.nom_categorie, r.temps_de_preparation 
                    FROM recette r
                    INNER JOIN categorie c ON c.id_categorie = r.id_categorie' ;

    $recipesStatement = $mysqlClient->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();

    foreach ($recipes as $recipe){
        echo ("<tr>
                    <td><a href = 'detailRecette.php?id=$recipe[id_recette]'>$recipe[nom_recette]</td>
                    <td>$recipe[nom_categorie]</td>
                    <td>$recipe[temps_de_preparation]</td>
                </tr>");
    }
    ?>
        </tbody>
    </table>
</body>
</html>