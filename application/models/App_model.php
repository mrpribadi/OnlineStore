<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * 
 */
class App_model extends CI_Model
{

	function insert_data($table, $data){
		return $this->db->insert($table, $data);
	}

	function update_data($table, $data, $key){
		return $this->db->update($table, $data, $key);
	}

	function delete_data($table, $data){
		$this->db->where($data);
		$query = $this->db->delete($table);
		return $query;
	}

	function get_data($table, $key, $column, $type){
		$this->db->where($key);
		$this->db->order_by($column, $type);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_data_query($sql){
		$query = $this->db->query($sql);
		return $query;
	}

	function search_item($keyword){
        $this->db->like('nama_item', $keyword , 'both');
        $this->db->order_by('nama_item', 'ASC');
        $this->db->limit(10);
        return $this->db->get('mst_item')->result();
	}
	
}