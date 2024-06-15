<?php
/**
 * 
 * GESTION DES POKEMONS
 * 
 */

/** fonction de récupération des pokémons */
function getPokemonTrainer($optionnals = []):int|array{

    /** colonnes de la tables types */
    $columnsNames = array_merge(
        getColumnsNames('pokemons'),
        getColumnsNames('trainers')
    );

    /** préparation de la requête */
    $sql='SELECT pokemons.id, pokemons.name, 
        pokemon_trainer.pokelevel, pokemon_trainer.hp, pokemon_trainer.maxhp,
        pokemon_trainer.attack, pokemon_trainer.defense, 
        pokemon_trainer.spatk, pokemon_trainer.spdef, 
        pokemon_trainer.speed,
        primary_type.name, secondary_type.name	
    FROM pokemons
    RIGHT JOIN pokemon_trainer ON (pokemon_trainer.pokemon_id = pokemons.id)
    RIGHT JOIN trainers ON (trainers.id = pokemon_trainer.trainer_id)
    INNER JOIN types AS primary_type ON (pokemons.primary_type = primary_type.id)
    LEFT JOIN types AS secondary_type ON (pokemons.secondary_type = secondary_type.id)';

    if(isset($optionnals)){ // construction de la clause WHERE
        $i = 0;
        foreach($optionnals as $column => $value){

            if(in_array($column, $columnsNames)){
                $sql.= ( $i == 0 ? ' WHERE ' : ' AND ' ) . 'trainers.'. $column . ' = ' . ( is_int($value) ? $value : '\''. $value .'\'' );
            }
            else {
                return 400;
            }
            ++$i;
        }
    }
    $sql.=' GROUP BY pokemons.id';
    $stmt = $GLOBALS['connect']->prepare($sql);


    /** exécution de la requête */
    $stmt->execute();

    /** fonction de callback */
    $callback=function($pokemon_id, $pokemon_name, $pokemon_level, $pokemon_hp, $pokemon_hpmax, $pokemon_attack, $pokemon_defense, $pokemon_spatk, $pokemon_spdef, $pokemon_speed, $primary_type, $secondary_type) {
        return [
            'pokemon_id' => $pokemon_id, 
            'pokemon_name' => $pokemon_name, 
            'pokemon_level' => $pokemon_level, 
            'pokemon_hp' => $pokemon_hp, 
            'pokemon_hpmax' => $pokemon_hpmax, 
            'pokemon_attack' => $pokemon_attack, 
            'pokemon_defense' => $pokemon_defense, 
            'pokemon_spatk' => $pokemon_spatk, 
            'pokemon_spdef' => $pokemon_spdef, 
            'pokemon_speed' => $pokemon_speed, 
            'primary_type' => $primary_type, 
            'secondary_type' => $secondary_type, 
        ];
    };
    $result = $stmt->fetchAll(PDO::FETCH_FUNC, $callback);

    /** code retour */
    if(count($result) == 0)
        return 404;
    else
        return $result;

}

/** fonction de suppression d'un pokemon */
function postPokemonTrainer($trainer_id, $pokemon_id, $optionnals = []):int|array{

    /** colonnes de la tables types */
    $columnsNames = getColumnsNames('pokemon_trainer');

    /** préparation des valeurs à inserer */
    $sql_values = array_flip($columnsNames);
    $sql_values = array_fill_keys($columnsNames, 'null');

    $sql_values['trainer_id'] = $trainer_id;
    $sql_values['pokemon_id'] = $pokemon_id;
    foreach($optionnals as $column => $value){
        if(in_array($column,$columnsNames)){
            $sql_values[$column] = (is_int($value) ? $value : '\''. $value . '\'');
        }
        else
            return 400;
    }

    $values = implode(',',$sql_values);

    /** préparation de la requête */
    $sql = 'INSERT INTO pokemon_trainer 
        (trainer_id, pokelevel, hp, maxhp, attack, defense, spatk, spdef, speed, pokemon_id)
        VALUES ('. $values .')';
    $stmt = $GLOBALS['connect']->prepare($sql);

    /** exécution de la requête */
    $count = $stmt->execute();

    /** code retour */
    if($stmt->errorCode() !== '')
        return 200;
    else
        return 400;

}

/** fonction d'édition d'un pokemon du pool */
function putPokemonTrainer($trainer_id, $pokemon_id, $optionnals = []):int{

    /** colonnes de la tables types */
    $columnsNames = getColumnsNames('pokemon_trainer');
    
    /** préparation de la requête */
    $sql = 'UPDATE pokemon_trainer SET ';

    if(isset($optionnals)){ // construction de la clause WHERE
        $i = 0;
        foreach($optionnals as $column => $value){
            if(in_array($column, $columnsNames)){
                $sql.= ( $i > 0 ? ', ' : null ) .'pokemon_trainer.'. $column . ' = ' . ( is_int($value) ? $value : '\''. $value .'\'' );
            }
            else {
                return 400;
            }
            ++$i;
        }
    }
    $sql.= ' WHERE trainer_id = '. $trainer_id;
    $sql.= ' AND pokemon_id = '. $pokemon_id;
    $stmt = $GLOBALS['connect']->prepare($sql);

    /** exécution de la requête */
    $count = $stmt->execute();

    /** code retour */
    if($stmt->rowCount() === 0)
       return 404;

    if($stmt->errorCode() !== '')
        return 200;
    else
        return 400;

}

/** fonction de suppression d'un pokemon */
function deletePokemonTrainer($trainer_id, $pokemon_id):int{
    
    /** préparation de la requête */
    $sql = ' DELETE FROM pokemon_trainer';
    $sql.= ' WHERE trainer_id = '. $trainer_id;
    $sql.= ' AND pokemon_id = '. $pokemon_id;
    $stmt = $GLOBALS['connect']->prepare($sql);

    /** exécution de la requête */
    $stmt->execute();

    /** gestion erreur */
    if($stmt->rowCount() === 0)
        return 404;

    if($stmt->errorCode() !== '')
        return 200;
    else
        return 400;
}



?>