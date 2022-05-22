<?php

include_once "generateTable.php";
include_once "functions.php";
$query = selectAll();

//préparation des "," pour le C de csv (comma separated values)
$delimiter = ",";
//nom du fichier type : rapport2022-10-12.csv
$filename = "rapport" . date('Y-m-d') . ".csv";

// Création d'un pointeur fichier : https://www.php.net/manual/fr/function.fopen.php
$f = fopen('php://memory', 'w');

// Set column headers
$fields = array('Date de la demande', 'Expéditeur', 'Date réponse', 'Délai');
fputcsv($f, $fields, $delimiter);

// Output each row of the data, format line as csv and write to file pointer
foreach ($query as $key) {
    if ($key['date_sent'] == NULL) {
        $delay = getOpenDays(strtotime($key['date_reception']), time());
    } else {
        $delay = getOpenDays(strtotime($key['date_reception']), strtotime($key['date_sent']));
    }
    if ($delay <= 5) {
        if ($key['date_sent'] == NULL) {
            $delayString = "Il y a " . $delay . " jour(s) ouvré(s). L'échange est encore valide.";
        } else {
            $delayString = "Il y a " . $delay . " jour(s) ouvré(s). L'échange est valide.";
        }
    } else {
        if ($key['date_sent'] == NULL) {
            $delayString = "Il y a " . $delay . " jour(s) ouvré(s). Délai dépassé. Echange invalide";
        } else {
            $delayString = "Il y a " . $delay . " jour(s) ouvré(s). Echange invalide";
        }
        $lineData = array($key['date_reception'], $key['sent_by'], $key['date_sent'], $delayString);
        fputcsv($f, $lineData, $delimiter);
    }
}


// Move back to beginning of file
fseek($f, 0);

// Set headers to download file rather than displayed
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

//output all remaining data on a file pointer
fpassthru($f);
exit;
