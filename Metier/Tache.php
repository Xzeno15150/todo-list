<?php 

/**
 * 
 */
class Tache
{
	private $title;
	private $desc;
	private $date;

	public function __construct($title, $desc, $date)
	{
		$this->title = $title;
		$this->desc = $desc;
		$this->date = $date;
	}


}