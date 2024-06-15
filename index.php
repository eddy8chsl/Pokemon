<?php

include_once 'api/db.php';
include_once 'api/db.pokemons.php';
include_once 'api/db.types.php';
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

        <h1 class="tc">Liste des Pokemons</h1>
        <form method="get">
            <h2>Filtrer par type</h2>
            <p>
                <label>Type&nbsp;:</label>
                <select name="type">
                    <option value="0"></option>
                    <?php $response = getTypes();
                    foreach ($response as $key => $value) {
                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                    }
                    ?>

                </select>
            </p>
            <section>
                <p>
                    <button type="submit">Valider</button>
                </p>
            </section>
        </form>
        </form>
        <form method="put">
            <h2>Modification du premier type d'un Pokemon</h2>
            <p>
                <label for="pokemon">Pokemon&nbsp;:</label>
                <input type="text" id="pokemon" name="nompokemon" required />
                <label>Type&nbsp;:</label>
                <select name="modif">
                    <?php $response = getTypes();
                    foreach ($response as $key => $value) {
                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                    }
                    ?>

                </select>
            </p>
            <section>
                <p>
                    <button type="submit">Valider</button>
                </p>
            </section>
        </form>

        <?php
        /** GET: Récupération d'éléments en base */
        $mv = null;
        if (isset($_GET['type']) && $_GET['type'] != '0') {
            $mv = ['primary_type' => $_GET['type'], 'secondary_type' => $_GET['type']];
            $response = getPokemons($mv);
        } elseif (isset($_GET['modif']) && isset($_GET['nompokemon'])) {
            $id = getPokemons(['name' => $_GET['nompokemon']]);
            $id = $id[0]['id'];
            $mv = ['primary_type' => $_GET['modif']];
            $response = putPokemon($id, $mv);
        } else {
            $response = getPokemons();
        }
        if(is_int($response))
            message($response);
        else {
            $count = count($response);
            if($count > 0)
                neutral($count .' résultat'. ($count > 1 ? 's' : null) .' trouvés');
            else
                info('aucun résultat trouvé');

            $html='<ul class="liste liste--pokemons">';
            foreach ($response as $key => $value) {
                $html.= '<li class="liste__element pokemon">'
                       .'<div class="pokemon__id"><span aria-hidden="true">#</span>'. str_pad($value['id'], 3, '0', STR_PAD_LEFT) .'</div>'
                       .'<h2 class="pokemon__name">'. $value['name'] .'</h2>'
                       .'<div class="pokemon__type"><span class="type type--'. @strToLower($value['primary_type']) .'">'. $value['primary_type'] .'</span>'
                    .(isset($value['secondary_type']) ? '<span class="type type--'. @strToLower($value['secondary_type']) .'">'. $value['secondary_type'] .'</span></div>' : null)
                    .'</li>';
            }
            $html.= '</ul>';

            echo $html;
        }
    
        /** POST: ajout d'un enregistrement en base */ 
        //$response = postPokemon('name', 3, ['secondary_type' => 6]);
        //message($response);
        
        /** PUT: mise à jour d'un enregistrement */
        //$response = putPokemon(151, ['name' => 'Lopunny', 'primary_type' => 1 ]);
        //message($response);
        
        /** DELETE: suppression d'un enregistrement */
        //$response = deletePokemon(152);
        //message($response);
        
        ?>


    </main>

</body>
</html>
