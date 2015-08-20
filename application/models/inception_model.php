<?php
class Inception_model extends CI_Model{
    //protected $table='inception_form';
    function get_all_form(){
        $sql="select inception_service_line.line_description,inception_form.form_id,"
                . "inception_form.form_sql,inception_form.form_description,"
                . "inception_form.form_status,inception_form.create_time,"
                . "inception_form.approve_time,inception_form.excute_time,"
                . "leader_user.username as leader,create_user.username as creater "
                . "from inception_form,inception_service_line,admin_user as leader_user,"
                . "admin_user as create_user where inception_form.line_id=inception_service_line.line_id "
                . "and leader_user.user_id=inception_service_line.line_leader_id and "
                . "create_user.user_id=inception_form.user_id and (inception_form.user_id=? "
                . "or inception_service_line.line_leader_id=?)";   
        //$query = $this->db->query($sql);
        $query = $this->db->query($sql,array($this->session->userdata('uid'),$this->session->userdata('uid')));
        //$query = $this->db->get(); 
        if ($query->num_rows() > 0)
	{
            return $query->result_array();
	}
    }
    function get_form_info($form_id){
        $sql="select inception_service_line.line_description,"
                . "inception_form.form_id,inception_form.form_sql,"
                . "inception_form.form_description,inception_form.form_status,"
                . "inception_form.create_time,inception_form.approve_time,"
                . "inception_form.excute_time,leader_user.username as leader,"
                . "create_user.username as creater from inception_form,"
                . "inception_service_line,admin_user as leader_user,admin_user "
                . "as create_user where inception_form.line_id=inception_service_line.line_id "
                . "and leader_user.user_id=inception_service_line.line_leader_id and "
                . "create_user.user_id=inception_form.user_id and inception_form.form_id=? "
                . "and (inception_form.user_id=? or inception_service_line.line_leader_id=?)";
        $query = $this->db->query($sql,array($form_id,$this->session->userdata('uid'),$this->session->userdata('uid')));
        if ($query->num_rows() > 0)
	{
            return $query->result_array();
	}
    }
    function change_form_status($form_id,$status){
        $sql='update inception_form set form_status=? where form_id=?;';
        $query = $this->db->query($sql,array($status,$form_id));
    }
    function get_form_status($form_id){
        $sql='select inception_form.form_status,inception_form.user_id as creater_id,'
                . 'inception_service_line.line_leader_id as leader_id from '
                . 'inception_form,inception_service_line where inception_form.form_id=? '
                . 'and inception_form.line_id=inception_service_line.line_id;';
        $query = $this->db->query($sql,array($form_id));
        if ($query->num_rows() > 0)
	{
            //return $query->row(0);
            return $query->result_array();
	}
    }
    function get_service_line(){
        $sql='select inception_service_line.line_id,inception_service_line.line_description from '
                . 'inception_service_line,inception_user_line where inception_service_line.line_id=inception_user_line.line_id '
                . 'and (inception_user_line.user_id=? or inception_service_line.line_leader_id=?)';
        $query = $this->db->query($sql,array($this->session->userdata['uid'],$this->session->userdata['uid']));
        if ($query->num_rows() > 0)
	{
            //return $query->row(0);
            return $query->result_array();
	}
    }
    function add_inception_form($data){
        $sql='insert into inception_form (form_sql,form_description,form_status,user_id,line_id) values (?,?,?,?,?)';
        $query = $this->db->query($sql,$data);
    }
}
?>

