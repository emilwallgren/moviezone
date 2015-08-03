<?php  

/****************************************				
*																				*
* Rendera Content till sidkontrollern		*
*																				*	
*****************************************/

/**
  * Extrahera data från arrayen mz för enklare hantering i template-filerna
  */
  extract($mz);
 
 
/**
  * Inkludera template-funktionen
  */
  include(__DIR__ . '/functions.php');
  
  
/**
	* Inkludera template-filen
	*/
  include(__DIR__ . '/index.tpl.php');