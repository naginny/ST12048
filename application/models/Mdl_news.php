<?php

/*
 *	author Stella Tīda
 *	Mdl_news.php
 *	class Mdl_news extends CRUD
 * 
 *	functions:
 *	public function create(array $data);
 * 
 */

class Mdl_news extends CRUD
{
	protected $table = 'news';
	protected $key = 'id';
	
	public function create(array $data)
	{
		return parent::create($data);
	}
}

