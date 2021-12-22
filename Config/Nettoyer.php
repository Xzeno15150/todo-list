<?php

class Nettoyer
{
	
	public static function NettoyerString(string $string)
	{
		if (isset($string)) {
			return filter_var($string, FILTER_SANITIZE_STRING);
		}
	}

	public static function NettoyerInt(int $int)
	{
		if (isset($int)) {
			return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
		}
	}
}