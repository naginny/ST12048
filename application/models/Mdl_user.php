<?php

/*
 *	author Stella Tīda
 *  Mdl_user.php
 *	class Mdl_user extends CRUD
 * 
 *	functions:
 *	public function __construct()
 *	public function initialize()
 *	public function getId()
 *	public function create(array $data)
 *	public function login($email, $password)
 *	public function logout()
 *	public function getCurrentRecord()
 *	public function checkEmailExists($email)
 *	public function findByEmail($email)
 *	public function getPasswordHash()
 *	public function encrypt($string)
 *	public function getList()
 *	public function removeCompletely($user_id)
 *	public function isSuperAdmin()
 *	public function isAdmin()
 *	public function isUser()
 * 
 */

class Mdl_user extends CRUD
{
	const SESSION_KEY = 'unique_user_id';
	const DEFAULT_USER_ROLE = 'guest';
	
	protected $table = 'users';
	protected $key = 'id';
	protected $record = NULL;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('Email');
		$this->initialize();
	}
	
	public function initialize()
	{
		$user_id = $this->session->userdata(self::SESSION_KEY);
		if ($user_id)
		{
			$this->record = $this->read($user_id) ?: NULL;
		}
	}
	
	public function getId()
	{
		return $this->session->userdata(self::SESSION_KEY);
	}
	
	public function create(array $data)
	{
		$data['password'] = $this->encrypt($data['password']);
		$data['permissions_index'] = 1; //registered user
		return parent::create($data);
	}
	
	public function login($email, $password)
	{
		$record = $this->findByEmail($email);
		if ($record && $record['password'] == $this->encrypt($password))
		{
			$this->session->set_userdata(array(
				self::SESSION_KEY => $record['id'],
			));
			
			$this->initialize();
			
			parent::update($this->record['id'], array(
				'last_access_date' => date('Y-m-d H:i:s', time()),
			));
			return TRUE;
		}
		return FALSE;
	}
	
	public function logout()
	{
		$this->session->set_userdata(array(
			self::SESSION_KEY => NULL,
		));
		$this->initialize();
	}
	
	public function getCurrentRecord()
	{
		return $this->record;
	}
	
	public function checkEmailExists($email)
	{
		return (bool) $this->findByEmail($email);
	}
	
	public function findByEmail($email)
	{
		return $this->db->from($this->table)->where('email', $email)->get()->row_array();
	}

	public function getPasswordHash()
	{
		return !empty($this->record) ? $this->record['password'] : self::DEFAULT_USER_ROLE;
	}
	
	public function encrypt($string)
	{
		return md5($string);
	}
	
	public function getList()
	{
		// superadmins not listed
		return $this->db->from($this->table)->where('permissions_index <',3)->get()->result_array();
	}
	
	public function removeCompletely($user_id)
	{
		parent::delete($user_id);
	}
	
	// user rights
	
	public function isSuperAdmin()
	{
		return (!empty($this->record) ? $this->record['permissions_index'] : 0) == 3;
	}
	
	public function isAdmin()
	{
		return (!empty($this->record) ? $this->record['permissions_index'] : 0) > 1;
	}
	
	public function isUser()
	{
		return $this->getCurrentUserRights() > 0;
	}

}
?>