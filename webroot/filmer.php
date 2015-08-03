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
//$movieList = $movies->showMovieList(); 
$rows = $movies->pagination();




// Skapa nödvändigt innehåll och spara i mz-variabeln
$mz['title'] = "Filmer";
$mz['main'] = <<<EOD
<div class="container">
	<h1>Filmer</h1> 
$rows
</div>
EOD;

// När alla variabler är satta, inkludera templaten
include(MZ_THEME_PATH);