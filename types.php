<?php

include_once 'api/db.php';
include_once 'api/db.types.php';
include_once 'api/function.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Types - Pokédex</title>
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
                <li property="itemListElement" typeof="ListItem" aria-current="page"><span property="name">Liste des types</span></a>
            </ol>
        </nav>

        <h1 class="tc">Liste des types</h1>
        
        <?php

        /** GET: Récupération d'éléments en base */
        $response = getTypes();
        //$response = getTypes(['id' => 1]); // récupération d'un enregistrement précis
        if(is_int($response))
            message($response);
        else {
            $count = count($response);
            if($count > 0)
                neutral($count .' résultat'. ($count > 1 ? 's' : null) .' trouvés');
            else
                info('aucun résultat trouvé');

            //table($response);
            $html='<ul class="liste liste--types">';
            //table($response);
            foreach ($response as $key => $value) {
                $html.= '<li class="liste__element type">'
                       .'<div class="pokemon__type"><span class="type type--'. @strToLower($value['name']) .'">'. $value['name'] .'</span>'
                    .'</li>';
            }
            $html.= '</ul>';

            echo $html;
        }
    
        /** POST: ajout d'un enregistrement en base */ 
        //$response = postType('poison');
        //message($response); */
        
        /** PUT: mise à jour d'un enregistrement */
        //$response = putType(1, 'normal');
        //message($response);
        
        /** DELETE */
        //$response = deleteType(19);
        //message($response);
        
        ?>
    </main>
    
</body>
</html>