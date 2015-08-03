<?php 
/**
 * MZ 404-sida
 *
 */
// Inkludera config-filen
include(__DIR__.'/config.php'); 

//Erbjud logout om inloggad
$login = new CUsers($mz['database']);
$login->logout();

// Koppla upp till databasen
$db = new CBlog($mz['database']); 
$thePost = $db->showPost();
 
// Skapa nödvändigt innehåll och spara i mz-variabeln
$mz['title'] = "Nyheter";
$mz['main'] = <<<EOD
<div class="container">
	{$thePost}
</div>

EOD;

// När alla variabler är satta, inkludera templaten
include(MZ_THEME_PATH);