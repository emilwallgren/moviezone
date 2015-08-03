<?php 
/**
 * MZ 404-sida
 *
 */
// Inkludera config-filen
include(__DIR__.'/config.php'); 

//Skydda sidan med loginfunktioner
$login = new CUsers($mz['database']);
$login->loginProtected();
//samt erbjud logout
$login->logout();

// Koppla upp till databasen
$db = new CSettings($mz['database']); 
$showSettings = $db->generateSettings();
 
// Skapa nödvändigt innehåll och spara i mz-variabeln
$mz['title'] = "Inställningar";
$mz['main'] = <<<EOD
<div class="container">
	<h1>Inställningar</h1>
	$showSettings
</div>

EOD;

// När alla variabler är satta, inkludera templaten
include(MZ_THEME_PATH);