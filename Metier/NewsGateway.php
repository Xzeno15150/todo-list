<?php

/**
 * 
 */
public class NewsGateway
{
	private $con

	public function __construct(Connection $con)
	{
		$this->con = $con;
	}

	public function insert(News $news)
	{
		
	}
}