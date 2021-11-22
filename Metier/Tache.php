<?php 

/**
 * Tache 
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

	public function getTitle()
	{
		return $title;
	}

	public function getDesc()
	{
		return $desc;
	}

	public function getDate()
	{
		return $date;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setDesc($desc)
	{
		$this->desc = $desc;
	}

	public function setDate($date)
	{
		$this->date = $date;
	}
}