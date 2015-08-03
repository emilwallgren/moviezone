<?php  

class CSettings {
	
	public function generateSettings() {
	
		$settings = '<a href="edit-nyheter.php"><h2>Redigera Nyheter</h2></a>
								 <a href="edit-filmer.php"><h2>Redigera Filmer</h2></a>
								 <a href="users.php"><h2>Redigera Användare</h2></a>';
	
		return $settings;
	}
}