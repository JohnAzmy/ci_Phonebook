<?php
class Phonebook_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_entries($slug = FALSE)
    {
        if ($slug === FALSE)
        {
            $query = $this->db->get('phonebook');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('phonebook', array('name' => $slug));
        return $query->row_array();
    }
    
    public function get_item_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('phonebook');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('phonebook', array('id' => $id));
        return $query->row_array();
    }
    
    public function get_select_cats($id = 1)
    {
        //$where = "newstype=0 and iscat=$id";
        $where = array('newstype' => 0, 'iscat'=>$id);
        $this->db->select('id,title_en')
                   ->where($where);

        $query = $this->db->get('phonebook');
        $result = $query->result_array();
        $resultArray=array();
        $resultArray[0] = 'please select';
        foreach($result as $item){
            $resultArray[$item['id']] = $item['name'];
        }
        return $resultArray;
    }
    
    public function set_item($id = 0)
    {
        $this->load->helper('url');
 
        $slug = url_title($this->input->post('name'), 'dash', TRUE);
        $isactive = $this->input->post('chkActive');
        $isactive = ($isactive == 1)?1:0;
        
        $data = array(
            'name' => $this->input->post('name'),
            'number' => $this->input->post('number'),
            'isactive' => $isactive,
        );
        if ($id == 0) {
            $data['adddate'] = date('Y-m-d h:M:s');
            return $this->db->insert('phonebook', $data);
        } else {
            $data['updatedate'] = date('Y-m-d h:M:s');
            $this->db->where('id', $id);
            return $this->db->update('phonebook', $data);
        }
    }
    public function set_number($id = 0, $number='')
    {
        $this->load->helper('url');
 
        $data = array(
            'number' => $this->input->post('number'),
            'isactive' => $isactive,
        );
        
        if (isset($id)) {
            $this->db->where('id', $id);
            return $this->db->update('phonebook', $data);
        }
    }
    
    public function delete_item($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('phonebook');
    }
}