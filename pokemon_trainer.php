<?php

include_once 'api/db.php';
include_once 'api/db.trainers.php';
include_once 'api/db.pokemon_trainer.php';
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
        
        <?php
        $trainer = $_GET['trainer'];

        /** GET: Récupération d'éléments en base */
        $response = getTrainers(['id' => $trainer]);
        if(is_int($response))
            message($response);
        else
            $trainerName = $response[0]['name'];

        ?>

        <nav class="breadcrumb" role="navigation" aria-label="Vous êtes ici">
            <ol class="breadcrumb-list" typeof="BreadcrumbList" vocab="https://schema.org/">
                <li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="/"><span property="name">Accueil</span></a>
                <li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="trainers.php"><span property="name">Liste des dresseureuses</span></a>
                <li property="itemListElement" typeof="ListItem" aria-current="page"><span property="name"><?=$trainerName?></span></li>
            </ol>
        </nav>


        <?php

        $response = getPokemonTrainer(['id' => $trainer]);
        if(is_int($response))
            message($response);
        else {
            echo'<h1 class="tc">'.$trainerName.'</h1>';

            $count = count($response);
            if($count > 0)
                neutral($count .' résultat'. ($count > 1 ? 's' : null) .' trouvés');
            else
                info('aucun résultat trouvé');

            //table($response);
            $html='<ul class="liste liste--pokemons-trainer">';
            //table($response);
            foreach ($response as $key => $value) {
                $html.= '<li class="liste__element pokemon-trainer">'
                       .'<div class="pokemon__resume">'
                       .'<div class="pokemon__id"><span aria-hidden="true">#</span>'. str_pad($value['pokemon_id'], 3, '0', STR_PAD_LEFT) .'</div>'
                       .'<h2 class="pokemon__name">'. $value['pokemon_name'] .'</h2>'
                       .'<div class="pokemon__type"><span class="type type--'. @strToLower($value['primary_type']) .'">'. $value['primary_type'] .'</span>'
                       .(isset($value['secondary_type']) ? '<span class="type type--'. @strToLower($value['secondary_type']) .'">'. $value['secondary_type'] .'</span>' : null).'</div>'
                       .'</div>'
                       .'<div class="pokemon__stats">'
                       .'<div><b>Niveau</b><br>'. $value['pokemon_level'] .'</div>'
                       .'<div><b>PV</b><br>'. $value['pokemon_hp'] .'/'. $value['pokemon_hpmax'] .'</div>'
                       .'<div><b>Attaque</b><br>'. $value['pokemon_attack'] .'</div>'
                       .'<div><b>Vitesse attaque</b><br>'. $value['pokemon_spatk'] .'</div>'
                       .'<div><b>Défense</b><br>'. $value['pokemon_defense'] .'</div>'
                       .'<div><b>Vitesse défense</b><br>'. $value['pokemon_spdef'] .'</div>'
                       .'<div><b>Vitesse</b><br>'. $value['pokemon_speed'] .'</div>'
                       .'</div>'
                    .'</li>';
            }
            $html.= '</ul>';

            echo $html;
        }
    
        /** POST: ajout d'un enregistrement en base */ 
        //$response = postPokemonTrainer($trainer, $pokemon_id, []);
        //message($response);
        
        /** PUT: mise à jour d'un enregistrement */
        //$response = putPokemonTrainer($trainer, 1, ['hp' => 32, 'attack' => '12' ]);
        //message($response);
        
        /** DELETE: suppression d'un enregistrement */
        //$response = deletePokemonTrainer($trainer,1);
        //message($response);
        
        ?>

        <nav class="tc myl">
            <b><a href="trainers.php">Retourner à la liste</a></b>
        </nav>

    </main>
    
</body>
</html>