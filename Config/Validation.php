<?php

/**
 * 
 */
class Validation
{
	
	public static function validationMail(string $email) : string
	{
		if (isset($email)) {
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}
	}

	public static function validationPage(int $page, int $nbpages) : int
	{
		if (isset($page)) {
			$page = filter_var($page, FILTER_VALIDATE_INT);
			if ($page <= 0 || $page > $nbpages) {
				return 1;
			}
			return $page;
		}
		return 1;
	}
}