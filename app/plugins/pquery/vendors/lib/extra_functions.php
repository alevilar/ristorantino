<?php

function limpiar_nombre($string) {
    // replace accented chars
    $accents = '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig);/';
    $string_encoded = htmlentities($string,ENT_NOQUOTES,'UTF-8');

    //$string = preg_replace($accents,'$1',$string_encoded);

    // clean out the rest
    $replace = array('([\40])','(-{2,})');
    $with = array('-','-');
    $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
    $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
    $string = strtr($string,$tofind,$replac);

    $string = preg_replace($replace,$with,$string);

    return low($string);
}
