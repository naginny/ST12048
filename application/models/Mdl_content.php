<?php

/*
 *	author Stella Tīda
 *	Mdl_content.php
 *	class Mdl_content extends CRUD
 * 
 *	functions:
 *	public function create(array $data);
 * 
 */

class Mdl_content extends CRUD
{
	protected $table = 'contents';
	protected $key = 'id';
	
	public function create(array $data)
	{
		return parent::create($data);
	}
	
	
}
