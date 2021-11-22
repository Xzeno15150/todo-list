<?php

/**
 * 
 */
public class News 
{
	private string $title;
	private string $text;
	
	public function __construct(string $title, string $text)
	{
		$this->title = $title;
		$this->text = $text;
	}

	public function getTitle() : string
	{
		return $this->title;	
	}

	public function getText() : string
	{
		return $this->text
	}

	public function getTitle($title)
	{
		$this->title = $title;
	}

	public function getText($text)
	{
		$this->text = $text;
	}
}
