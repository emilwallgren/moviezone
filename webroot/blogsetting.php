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
$blog = new CBlog($mz['database']);
$blogForm = $blog->generateBlogForm();
if (isset($_POST['submit'])) {
	$blog->insertFormData();
}

 
// Skapa nödvändigt innehåll och spara i mz-variabeln
$mz['title'] = "Nyheter";
$mz['main'] = <<<EOD
<div class="container">
	<h1>Skapa ny Bloggpost</h1>
	$blogForm
</div>
	
	
EOD;
 
// När alla variabler är satta, inkludera templaten
include(MZ_THEME_PATH);