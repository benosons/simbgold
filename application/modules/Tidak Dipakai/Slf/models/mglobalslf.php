<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mglobalslf extends CI_Model{
	
	
	public function setData($table,$data,$key='',$value='')
	{
		$this->db->set('last_update','NOW()',FALSE);
		if($value != '')
		{
			$this->db->where($key,$value);
			$this->db->update($table,$data);
			return $this->db->affected_rows();
		}else{
			$this->db->insert($table,$data);
			return $this->db->insert_id();
		}
	}
	
	public function setUpdate($table,$data,$key='',$value='')
	{
		$this->db->set('last_update','NOW()',FALSE);
		if($value != '')
		{
			$this->db->where($key,$value);
			$this->db->update($table,$data);
			return $this->db->affected_rows();
		}
	}
	
	public function setData2Filter($table,$data,$key1='',$value1='',$key2='',$value2='')
	{
		$this->db->set('last_update','NOW()',FALSE);
		if($value1 != '')
		{
			$this->db->where($key1,$value1);
			$this->db->where($key2,$value2);
			$this->db->update($table,$data);
			return $this->db->affected_rows();
		}else{
			$this->db->insert($table,$data);
			return $this->db->insert_id();
		}
	}
	
}