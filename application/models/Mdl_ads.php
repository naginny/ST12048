<?php

/*
 *	author Stella Tīda
 *	Mdl_ads.php
 *	class Mdl_ads extends CRUD
 * 
 *	functions:
 *	public function create(array $data);
 * 
 */

class Mdl_ads extends CRUD
{
	protected $table = 'ad';
	protected $key = 'id';
	
	public function create(array $data)
	{
		$data['authorId'] = $this->mdl_user->getId();
		return parent::create($data);
	}
}
