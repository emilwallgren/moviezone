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
$blog = new CBlog($mz['database']); 
$blogLinks = $blog->blogForHomePage();

$movie = new CMovies($mz['database']); 
$movieLinks = $movie->movieForHomePage();
$categories = $movie->showCategories();
$mostPopular = $movie->mostPopular();

$content = $categories . $blogLinks . $movieLinks . $mostPopular;

// Skapa nödvändigt innehåll och spara i mz-variabeln
$mz['title'] = "Hem";
$mz['main'] = <<<EOD
<div class="jumbotron">
	<div class="container">
  <h1>MovieZone</h1>
  <p>Veckans film: Indiana Jones</p>
  <p><a class="btn btn-primary btn-lg" href="film.php?number=25" role="button">Läs mer</a></p>
  </div>
</div>
<div class="container">
$content
</div>


EOD;

 
// När alla variabler är satta, inkludera templaten
include(MZ_THEME_PATH);