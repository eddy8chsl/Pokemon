<?php

/**
 * 
 * FORMATAGE HTML
 * 
 */

/** formate un tableau PHP en ul HTML */
function table($list){

    $html = '<div class="table">';
    foreach ($list as $list_key => $list_items) {
        $html.='<div class="row">';
        foreach ($list_items as $item_key => $item_value) {
            $html.= '<div class="col"><span class="'.strToLower($item_value).'">'. $item_value .'</span></div>';
        }
        $html.='</div>';
    }
    $html.= '</div>';

    echo $html;
}

/**
 * 
 * GESTION DES MESSAGES RETOURS
 * 
 */

/** affiche le message du code retour au format HTML */
function message($code = 200){

    switch ($code) {
        case 200:
            $message = 'Requête traitée avec succès';
            success($message);
        break;

        case 201:
            $message = 'Requête traitée avec succès et création ou modification de l\'enregistrement';
            success($message);
        break;

        case 400:
            $message = 'La syntaxe de la requête est erronée';
            error($message);
        break;

        case 404:
            $message = 'Aucun résultat trouvé';
            info($message);
        break;

        default:
            $message = 'Erreur non prévue';
            error($message);
        break;
    }

}

/** information */
function info($message){
    echo '<p class="'. __FUNCTION__ .'">'. $message .'</p>';
}

/** warning */
function warning($message){
    echo '<p class="'. __FUNCTION__ .'">'. $message .'</p>';
}

/** erreur */
function error($message){
    echo '<p class="'. __FUNCTION__ .'">'. $message .'</p>';
}

/** success */
function success($message){
    echo '<p class="'. __FUNCTION__ .'">'. $message .'</p>';
}

/** success */
function neutral($message){
    echo '<p class="'. __FUNCTION__ .'">'. $message .'</p>';
}


?>