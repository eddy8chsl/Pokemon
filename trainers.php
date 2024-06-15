<?php

include_once 'api/db.php';
include_once 'api/db.trainers.php';
include_once 'api/function.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon - Pokédex</title>
    <link rel="stylesheet" href="assets/style.min.css">
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Pokemons</a></li>
                <li><a href="types.php">Types</a></li>
                <li><a href="trainers.php">Dresseureuses</a></li>
            </ul>
        </nav>
    </header>

    <main>
    
        <nav class="breadcrumb" role="navigation" aria-label="Vous êtes ici">
            <ol class="breadcrumb-list" typeof="BreadcrumbList" vocab="https://schema.org/">
                <li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="/"><span property="name">Accueil</span></a>
                <li property="itemListElement" typeof="ListItem" aria-current="page"><span property="name">Liste des dresseureuses</span></a>
            </ol>
        </nav>

        <h1 class="tc">Liste des dresseureuses</h1>

        <?php

        /** GET: Récupération d'éléments en base */
        $response = getTrainers();
        //$response = getTrainers(['id' => 1]); // récupération d'un enregistrement précis
        //$response = getTrainers(['name' => 'A-list Actor Ricardo']); // récupération d'un enregistrement précis
        if(is_int($response))
            message($response);
        else {
            $count = count($response);
            if($count > 0)
                neutral($count .' résultat'. ($count > 1 ? 's' : null) .' trouvés');
            else
                info('aucun résultat trouvé');
        
            //table($response);
            $html='<ul class="liste liste--trainers">';
            //table($response);
            foreach ($response as $key => $value) {
                $html.= '<li class="liste__element trainers">'
                       .'<div class="trainer__name"><a href="pokemon_trainer.php?trainer='. $value['id'] .'">'. $value['name'] .'</a></div>'
                    .'</li>';
            }
            $html.= '</ul>';

            echo $html;
        }

        /** POST: ajout d'un enregistrement en base */ 
        //$response = postTrainer(['name' => 'Mathieu']);
        //message($response);

        /** PUT: mise à jour d'un enregistrement */
        //$response = putTrainer(3, ['name' => 'normal']);
        //message($response);
        
        /** DELETE: suppression d'un enregistrement */
        //$response = deleteTrainer(3);
        //message($response);
        ?>
        
    </main>
    
</body>
</html>