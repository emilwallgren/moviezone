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
 
// Skapa nödvändigt innehåll och spara i mz-variabeln
$mz['title'] = "Om Oss";
$mz['main'] = <<<EOD
<div class="container">
	<h1>Det här är MovieZone</h1>
	<div class="row">
		<div class="col-md-offset-2 col-md-2">
			<img src="img.php?src=emilwallgren.jpg&width=300" alt="Emil Wallgren"/>
		</div>
		<div class="col-md-8">
		<p class="descriptions">MovieZone är skapad av Emil Wallgren och är till för att få dom senaste nyheterna vad gäller allt inom filmvärlden. Emil är 25 år och studerar webbutveckling vid Blekinge Tekniska Högskola. Han har precis tagit examen i Civilekonomi ifrån Luleå Tekniska Universitet och har precis flyttat hem till göteborg.<br><br>MovieZone är ett avslutande moment i kursen OOPHP där kursen går ut på att utbilda objektorienterad programmering. Hemsidan är ett egenutvecklat Content Management System där man kan logga in och publicera samt uppdatera innehåll på webbplatsen. MovieZone är till för filmälskare som snabbt och lätt vill få tillgång och tips till underhållande filmer. Här publiceras även nyheter kring hemsidan och filmvärlden i övrigt.<br><br>Välkommen till MovieZone!<br><i>/Emil Wallgren</i></p>
		</div>
	</div>
</div>
EOD;
 
// När alla variabler är satta, inkludera templaten
include(MZ_THEME_PATH);