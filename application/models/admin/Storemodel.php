<?php
class Storemodel extends CI_Model {
    public function liststores()
	{
		$this->db->select('*');
		$this->db->from('store');
		//$this->db->where('is_active', 1);
		$this->db->order_by("store_id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

// user role id

public function listuserroleid()
	{
		$this->db->select('*');
		$this->db->from('users');
		//$this->db->where('is_active', 1);
		$this->db->order_by("userroleid", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}



	public function listclientscsv()
	{
		$this->db->select('id,name,email,phone,address');
		$this->db->from('customer');
		$this->db->where('is_active', 1);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function insert($data){
	    $this->db->insert('store',$data);
		return $this->db->insert_id();
	}
	public function insert_store_table($data){
	    $this->db->insert('store_table',$data);
		return $this->db->insert_id();
	}
	public function delete($id){
	    // $data = array('is_active' => 0);
        $this->db->where('store_id', $id);
		return $this->db->delete('store');
        // $this->db->update('store');
        // return true;
	}
	public function get_store_by_id($id){
	    $this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_id',$id );
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getStoreDetails($id){
	    $this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_id',$id );
		$query = $this->db->get();
		return $query->result_array();
	}
	public function update($id,$data){
	    $this->db->where('store_id', $id);
        $this->db->update('store', $data);
        return true;
	}
}
?>