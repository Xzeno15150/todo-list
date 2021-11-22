<?php

/**
 * 
 */
public class Validation
{
	
	public static function validationMail(string $email) : string
	{
		if (isset($email)) {
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}
	}

	public static function validationString(string $text) : string
	{
		if (isset($text)) {
			return filter_var()
		}
	}
}