<?php
function chiffreEnLettre($nombre) {
    $unites = array('', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf');
    $dizaines = array('', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingt', 'quatre-vingt-dix');
    $dizainesSpeciales = array('onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize');

    if ($nombre < 10) {
        return $unites[$nombre];
    } elseif ($nombre < 20) {
        return $dizainesSpeciales[$nombre - 11];
    } elseif ($nombre < 100) {
        $dizaine = (int)($nombre / 10);
        $unite = $nombre % 10;
        $resultat = $dizaines[$dizaine];
        if ($unite != 0) {
            $resultat .= '-' . chiffreEnLettre($unite);
        }
        return $resultat;
    } elseif ($nombre < 1000) {
        $centaine = (int)($nombre / 100);
        $reste = $nombre % 100;
        $resultat = $unites[$centaine] . ' cent';
        if ($reste != 0) {
            $resultat .= ' ' . chiffreEnLettre($reste);
        }
        return $resultat;
    } elseif ($nombre < 10000) {
        $millier = (int)($nombre / 1000);
        $reste = $nombre % 1000;
        $resultat = chiffreEnLettre($millier) . ' mille';
        if ($reste != 0) {
            $resultat .= ' ' . chiffreEnLettre($reste);
        }
        return $resultat;
    } else {
        return 'Nombre trop grand';
    }
}

// Exemple d'utilisation
$nombre = 2234;
echo chiffreEnLettre($nombre);
?>
