<?php

/**
 * 
 */
class Nettoyer
{
	
	public static function NettoyerString(string $string)
	{
		if (isset($tring)) {
			return filter_var($string, FILTER_SANITIZE_STRING);
		}
	}
}