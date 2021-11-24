<?php 

/**
 * Tache 
 */
class Tache
{
	private $id;
	private $title;
	private $desc;
	private $date;

	public function __construct($id, $title, $desc, $date)
	{
		$this->id = $id;
		$this->title = $title;
		$this->desc = $desc;
		$this->date = $date;
	}
	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getDesc()
	{
		return $this->desc;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function setId($id)
	{
		$this->id = $id;
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