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
$showTheBlog = $db->showBlogForCategory();

$db = new CMovies($mz['database']); 
$showTheMovies = $db->presentSearch();
 
// Skapa nödvändigt innehåll och spara i mz-variabeln
$mz['title'] = "Kategorier";
$mz['main'] = <<<EOD
<div class="container">
{$showTheBlog}
{$showTheMovies}
</div>
EOD;

// När alla variabler är satta, inkludera templaten
include(MZ_THEME_PATH);