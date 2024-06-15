<?php
/**
 * 
 * GESTION DES DRESSEUREUSES
 * 
 */

/** fonction de récupération des pokémons */
function getTrainers($optionnals = []):int|array{

    /** colonnes de la tables types */
    $columnsNames = getColumnsNames('trainers');

    /** préparation de la requête */
    $sql='SELECT id, name FROM trainers';
    if(isset($optionnals)){ // construction de la clause WHERE
        $i = 0;
        foreach($optionnals as $column => $value){
            if(in_array($column, $columnsNames)){
                $sql.= ( $i == 0 ? ' WHERE ' : ' AND ' ) . $column . '=' . ( is_int($value) ? $value : '\''. $value .'\'' );
            }
            else {
                return 400;
            }
            ++$i;
        }
    }
    $sql.=' GROUP BY name';
    $stmt = $GLOBALS['connect']->prepare($sql);

    /** exécution de la requête */
    $stmt->execute();

    /** fonction de callback */
    $callback=function($id, $name) {
        return [
            'id' => $id,
            'name' => $name,
        ];
    };
    $result = $stmt->fetchAll(PDO::FETCH_FUNC, $callback);

    /** gestion erreur */
    if(count($result) == 0)
        return 404;
    else
        return $result;

}

/** fonction de suppression d'un pokemon */
function postTrainer($optionnals = []):int|array{

    /** colonnes de la tables types */
    $columnsNames = getColumnsNames('trainers');
    
    /** préparation de la requête */
    $sql = 'INSERT INTO trainers 
        (name)
        VALUES (\''. @$optionnals['name'] .'\')';
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
function putTrainer($id, $optionnals = []):int{

    /** préparation de la requête */
    $sql = 'UPDATE trainers SET ';
    $sql.= 'name = \''. @$optionnals['name'] . '\'';
    $sql.= ' WHERE id = '.$id;
    $stmt = $GLOBALS['connect']->prepare($sql);

    /** exécution de la requête */
    $count = $stmt->execute();
    
    /** gestion erreur */
    if($stmt->rowCount() === 0)
       return 404;

    if($stmt->errorCode() !== '')
        return 200;
    else
        return 400;

}

/** fonction de suppression d'un pokemon */
function deleteTrainer($id):int{

    /** contrôle des données d'entrée */
    if(!isset($id)){
        return 400;
    }
    
    /** préparation de la requête */
    $sql = 'DELETE FROM trainers WHERE id = '.$id;

    $stmt = $GLOBALS['connect']->prepare($sql);
    $stmt->execute();

    /** code retour */
    if($stmt->rowCount() === 0)
        return 404;

    if($stmt->errorCode() !== '')
        return 200;
    else
        return 400;
}



?>