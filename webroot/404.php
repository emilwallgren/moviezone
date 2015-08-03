<?php 
/**
 * MZ 404-sida
 *
 */
// Inkludera config-filen
include(__DIR__.'/config.php'); 
 
 
// Skapa nödvändigt innehåll och spara i mz-variabeln
$mz['title'] = "404";
$mz['main'] = "This is a Anax 404. Document is not here.";
 
// Send the 404 header 
header("HTTP/1.0 404 Not Found");
 
 
// När alla variabler är satta, inkludera templaten
include(MZ_THEME_PATH);
 