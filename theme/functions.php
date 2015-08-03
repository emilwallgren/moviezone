<?php 

/******************************		
*															*
* Tema-relaterade funktioner	*
*															*	
*******************************/

/**
 * Get title for the webpage by concatenating page specific title with site-wide title.
 *
 * @param string $title for this page.
 * @return string/null wether the favicon is defined or not.
 */
 
 function get_title($title) {
 
 		global $mz;
 		return $title . (isset($mz['title_append']) ? $mz['title_append'] : null);
 
 }
