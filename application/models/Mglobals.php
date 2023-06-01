<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mglobals extends CI_Model
{


	public function getData($select = '*', $table, $where = '', $sort = '', $order = '')
	{
		$this->db->select($select, FALSE);
		(($where != '') ? $this->db->where($where) : '');
		(($order != '') ? $this->db->order_by($sort, $order) : '');
		return $this->db->get($table);
	}
	
	public function getDataTeknis($select = '*', $table, $where = '', $sort = '', $order = '')
	{
		$this->db->select($select, FALSE);
		(($where != '') ? $this->db->where($where) : '');
		(($order != '') ? $this->db->order_by($sort, $order) : '');
		return $this->db->get($table);
	}

	public function getDataUser($select = "*")
	{
		$this->db->select($select, FALSE);
		return $this->db->get('user a');
	}
	
	public function getId()
	{
		return $this->db->insert_id();
	}

	public function setData($table, $data, $key = '', $value = '')
	{

		if ($value != '') {
			$this->db->set('last_update', 'NOW()', FALSE);
			$this->db->where($key, $value);
			$this->db->update($table, $data);
			return $this->db->affected_rows();
		} else {
			$post = $this->session->userdata('loc_email') ? $this->session->userdata('loc_email') : 'System Apps';
			$this->db->set('post_by', "'$post'", FALSE);
			$this->db->set('post_date', 'NOW()', FALSE);
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}
	}
	
	public function setDatakol($table, $dataKolektif, $key = '', $value = '')
	{

		if ($value != '') {
			$this->db->set('last_update', 'NOW()', FALSE);
			$this->db->where($key, $value);
			$this->db->update($table, $dataKolektif);
			return $this->db->affected_rows();
		} else {
			$post = $this->session->userdata('loc_email') ? $this->session->userdata('loc_email') : 'System Apps';
			$this->db->set('post_by', "'$post'", FALSE);
			$this->db->set('post_date', 'NOW()', FALSE);
			$this->db->insert($table, $dataKolektif);
			return $this->db->insert_id();
		}
	}

	public function setDatas($table = '', $where = '1=1', $key = '', $sort = '', $limit = '')
	{
		return $query = $this->db->from($table)->where($where)->order_by($key, $sort)->limit($limit)->get();
	}

	public function deleteData($table, $id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($table);
	}

	public function deleteDataKey($table, $key = 'id', $value)
	{
		$this->db->where($key, $value);
		return $this->db->delete($table);
	}

	public function multideleteData($table, $key = 'id', $value)
	{
		foreach ($table as $row) {
			$this->db->where($key, $value);
			return $this->db->delete($row);
		}
	}

	public function setDaftar($value = '')
	{
		$this->db->set('last_update', 'NOW()', FALSE);
		$this->db->where('status', NULL);
		$this->db->where($key, $value);
		return $this->db->update($table, $data);
	}


	public function checkingData($field, $key, $table)
	{
		$this->db->select('id', FALSE);
		$this->db->where($field, $key);
		return $this->db->get($table);
	}

	public function listData($table, $select = "*", $key = '', $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where($key, $id);
		$query 	= $this->db->get($table);
		return $query;
		// if ($query->num_rows() > 0) {
		// 	foreach ($query->result() as $key) {
		// 		if ($key->id == $DataSumber->id) {
		// 			$plhrole = "selected";
		// 		} else {
		// 			$plhrole = "";
		// 		}
		// 		echo '<option value="' . $key->id . '" ' . $plhrole . '>' . $key->nama . '</option>';
		// 	}
		// }
	}
}
