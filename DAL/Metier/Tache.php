<?php 

/**
 * Tache 
 */
class Tache
{
	private $id;
	private $title;
	private $desc;
	private $checked;

	public function __construct($title, $desc, $id=NULL, $checked=0)
	{
		$this->id = $id;
		$this->title = $title;
		$this->desc = $desc;
		$this->checked = $checked;
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


	public function getChecked()
	{
		return $this->checked;
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

	public function setChecked($checked)
	{
		$this->checked = $checked;
	}
}