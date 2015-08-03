<?php 
/**
 * MZ Filmsida
 *
 */
// Inkludera config-filen
include(__DIR__.'/config.php'); 

//Erbjud logout om inloggad
$login = new CUsers($mz['database']);
$login->logout();

$movies = new CMovies($mz['database']);
$singleMovie = $movies->showSingleMovie(); 


// Skapa nödvändigt innehåll och spara i mz-variabeln
$mz['title'] = "Film";
$mz['main'] = <<<EOD
<div class="container">
	$singleMovie
</div>
EOD;

// När alla variabler är satta, inkludera templaten
include(MZ_THEME_PATH);