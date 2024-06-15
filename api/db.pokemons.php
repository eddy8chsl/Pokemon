<?php
/**
 * 
 * GESTION DES POKEMONS
 * 
 */

/** fonction de récupération des pokémons */
function getPokemons($optionnals = []):int|array{

    /** colonnes de la tables types */
    $columnsNames = getColumnsNames('pokemons');

    /** préparation de la requête */
    $sql='SELECT pokemons.id, pokemons.name, primary_type.name, secondary_type.name
    FROM pokemons
    INNER JOIN types AS primary_type ON (pokemons.primary_type = primary_type.id)
    LEFT JOIN types AS secondary_type ON (pokemons.secondary_type = secondary_type.id)';

    if(isset($optionnals)){ // construction de la clause WHERE
        $i = 0;
        foreach($optionnals as $column => $value){
            if(in_array($column, $columnsNames)){
                $sql.= ( $i == 0 ? ' WHERE ' : ' OR ' ) . 'pokemons.'. $column . ' = ' . ( is_int($value) ? $value : '\''. $value .'\'' );
            }
            else {
                return 400;
            }
            ++$i;
        }
    }
    $stmt = $GLOBALS['connect']->prepare($sql);

    /** exécution de la requête */
    $stmt->execute();

    /** fonction de callback */
    $callback=function($id, $name, $primary_type, $secondary_type) {
        return [
            'id' => $id, 
            'name' => $name, 
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
function postPokemon($name, $primary_type, $optionnals = []):int|array{
    
    /** préparation de la requête */
    $sql = 'INSERT INTO pokemons 
        (name, primary_type, secondary_type)
        VALUES (\''. $name .'\', '. $primary_type .','. (@$optionnals['secondary_type'] ? $optionnals['secondary_type'] : 'null') .')';
    $stmt = $GLOBALS['connect']->prepare($sql);

    /** exécution de la requête */
    $count = $stmt->execute();

    /** code retour */
    if($stmt->errorCode() !== '')
        return 200;
    else
        return 400;

}

/** fonction d'édition d'un pokemon */
function putPokemon($id, $optionnals = []):int{

    /** contrôle des données d'entrée */
    if(!isset($id)){
        return 400;
    }

    /** colonnes de la tables types */
    $columnsNames = getColumnsNames('pokemons');
    
    /** préparation de la requête */
    $sql = 'UPDATE pokemons SET ';

    if(isset($optionnals)){ // construction de la clause WHERE
        $i = 0;
        foreach($optionnals as $column => $value){
            if(in_array($column, $columnsNames)){
                $sql.= ( $i > 0 ? ', ' : null ) .'pokemons.'. $column . ' = ' . ( is_int($value) ? $value : '\''. $value .'\'' );
            }
            else {
                return 400;
            }
            ++$i;
        }
    }
    $sql.= ' WHERE id = '.$id;
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
function deletePokemon($id):int{
    
    /** préparation de la requête */
    $sql = 'DELETE FROM pokemons WHERE id = '.$id;
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