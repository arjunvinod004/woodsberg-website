<?php
class Rolemodel extends CI_Model {
    public function listroles()
	{
		$this->db->select('*');
		$this->db->from('role');
		$this->db->where('is_active', 1);
		$this->db->order_by("roleid", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function insert($data){
	    $this->db->insert('role',$data);
	}
	public function getPermissions($moduleid,$roleid){
		$this->db->select('*');
		$this->db->from('privilege');
		$this->db->where('roleid',$roleid );
		$this->db->where('moduleid',$moduleid );
		$query = $this->db->get();
		return $query->result_array();
	}
	public function delete($id){
	    $data = array('is_active' => 0);
        $this->db->where('roleid', $id);
        $this->db->update('role', $data);
        return true;
	}
	public function get($roleid){
	    $this->db->select('*');
		$this->db->from('role');
		$this->db->where('roleid',$roleid );
		$query = $this->db->get();
		return $query->result_array();
	}
	public function update($roleid,$roledata){
	    $this->db->where('roleid', $roleid);
        $this->db->update('role', $roledata);
        return true;
	}
	public function listmodules()
	{
        $this->db->select('*');
		$this->db->from('module');
		$this->db->where('is_active', 1);
		$this->db->order_by("moduleid", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function fetchaccessmodule($roleid)
	{
		$this->db->select('p.*,m.*');
		$this->db->from('privilege as p');
        $this->db->join('module as m', 'p.moduleid = m.moduleid','left');
		$this->db->where('p.roleid', $roleid);
		$this->db->where('m.is_active',1);
		$this->db->where('m.ordernumber!=',0);
		$this->db->order_by("m.ordernumber", "asc");
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}
	public function insertprivilege($data)
	{
		$this->db->insert('privilege',$data);
	}
	public function updateprivilege($data,$id){
		$this->db->where('privilegeid ', $id);
        $this->db->update('privilege', $data);
        return true;
	}
	public function check_privilege_exist($roleid,$module_id){
		$this->db->select('*');
		$this->db->from('privilege');
		$this->db->where('roleid', $roleid);
		$this->db->where('moduleid', $module_id);
		$query = $this->db->get();
		return $query->row();
	}
	public function getRoleName($id){
		$this->db->select('rolename');
		$this->db->from('role');
		$this->db->where('roleid',$id );
		$query = $this->db->get();
		$row = $query->result_array();
		echo $row[0]['rolename'];
	}
	public function getUserName($id){
		$this->db->select('name');
		$this->db->from('users');
		$this->db->where('userid',$id );
		$query = $this->db->get();
		$row = $query->result_array();
		echo $row[0]['name'];
	}
	public function checkSubmenuExist($id){
		$this->db->select('*');
		$this->db->from('module');
		$this->db->where('parent_id',$id );
		$this->db->where('is_active',1 );
		$query = $this->db->get();
		return $query->result_array();
	}
	public function check_permission($module_id,$role_id,$key){
		//echo $module_id;echo $key;echo $role_id;
		$this->db->select($key);
		$this->db->from('privilege');
		$this->db->where('moduleid',$module_id);
		$this->db->where('roleid',$role_id);
		$query = $this->db->get();//echo $this->db->last_query();exit;
		$row = $query->row_array();//exit;
		return $row[$key];
	}
}
?>