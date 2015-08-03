<?php 

/**********************************				
*																	*
* Config-fil för MovieZone (mz)		*
*																	*	
***********************************/


/******************************************
* Starta felrapportering
*/
error_reporting(-1); 						// Rapportera alla sorts feltyper
ini_set('display_errors', 1); 	// Visa alla sorts fel
ini_set('output_buffering', 0);	// Buffra inte outputs, skriv direkt istället


/*******************************************
* Definiera MovieZones filvägar
*/
 define('MZ_INSTALL_PATH', __DIR__ . '/..');
 define('MZ_THEME_PATH', MZ_INSTALL_PATH . '/theme/render.php');
 
 
 /*******************************************
 * Inkludera Bootstrapping-funktioner
 */
 include(MZ_INSTALL_PATH . '/src/bootstrap.php');
 
 
 /*******************************************
 * Starta Sessionen
 */
 session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
 session_start();
 
 
 /*******************************************
 * Skapa MovieZone-variabeln
 */
 $mz = array();
 
 
 /*******************************************
 * Generella sidinställningar
 */
$mz['lang'] 				= 'sv';
$mz['title_append'] = ' | MovieZone';
$mz['charset'] = 'utf-8';
$mz['favicon'] = 'images/icon.png';
$mz['stylesheets'] = array('css/normalize.css', 'css/style.css');

$mz['database']['dsn'] 						= 'mysql:host=localhost;dbname=moviezone';
$mz['database']['username'] 			= 'root';
$mz['database']['password'] 			= 'root';
$mz['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");

//Header

$movie = new CMovies($mz['database']);
$showSearchBar = $movie->searchHeader();

$mz['header'] = <<<EOD
<div id="heading">
	<img id="logo" src="images/MovieZone.png" alt="logo-moviezone">
	<h2 id="slogan">DIN FILMBUTIK PÅ NÄTET</h2>
	<nav>
		$showSearchBar
		<a href="hem.php">Hem</a>
		<a href="filmer.php">Filmer</a>
		<a href="nyheter.php">Nyheter</a>
		<a href="omoss.php">Om Oss</a>
	</nav>
</div>

EOD;

//Footer

$login = new CUsers($mz['database']);
$showLogin = $login->showLogin();

$mz['footer'] = <<<EOD
<div id="footerContent">
	<a href="http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance">Unicorn</a>
	{$showLogin}
	<p>Copyright 2015 - MovieZone</p>
</div>

EOD;



?>