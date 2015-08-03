<?php 

/**********************************				
*																	*
* Bootstrap-fil för MovieZone: 		*
* Innehåller funktioner som är		*
* nödvändiga för en sidkontroller	*
* att fungera											*
*																	*	
***********************************/

/**
 * Standard exception handler
 */
	function myExceptionHandler($exception) {
	 echo "MovieZone uncaught exception: <p>" . $exception->getMessage() . "</p>";
	}
 	set_exception_handler('myExceptionHandler');
 
 /**
  * Autoladdare för klasser
  */
  
  function myAutoloader($class) {
  	$path = MZ_INSTALL_PATH . "/src/{$class}/{$class}.php";
  	if (is_file($path)) {
  		include($path);
  	}
  	else {
  		throw new Exception("Classfile: {$class} does not exist.");
  	}
  }
	spl_autoload_register('myAutoloader');
  
  