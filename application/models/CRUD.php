<?php

/*
 *	author Stella Tīda
 *  CRUD.php
 *	class CRUD extends CI_Model
 * 
 *	functions:
 *	public function create(array $data)
 *	public function read($id)
 *	public function readMany(array $where = NULL)
 *	public function update($id, array $data)
 *	public function delete($id)
 *	public function getTable()
 */

class CRUD extends CI_Model
{
	protected $table = NULL;
	protected $key = NULL;

	public function create(array $data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function read($id)
	{
		return $this->db->from($this->table)->where($this->key, $id)->limit(1)->get()->row_array();
	}
	
	public function readMany(array $where = NULL)
	{
		$this->db->from($this->table);
		$where && $this->db->where($where);
		return $this->db->get()->result_array();
	}
	
	public function update($id, array $data)
	{
		$this->db->where($this->key, $id)->update($this->table, $data);
	}
	
	public function delete($id)
	{
		$this->db->where($this->key, $id)->delete($this->table);
	}
	
	public function getTable()
	{
		return $this->table;
	}
}
