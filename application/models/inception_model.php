<?php
class Inception_model extends CI_Model{
    //protected $table='inception_form';
    //取出所有与当前登录用户相关的inception表单【不包含业务线被删除的】
    function get_all_form(){
        $sql="select inception_service_line.line_description,inception_form.form_id,"
                . "inception_form.form_sql,inception_form.form_description,inception_form.end_form_time,"
                . "inception_form.form_status,inception_form.create_time,"
                . "inception_form.approve_time,inception_form.excute_time,"
                . "leader_user.username as leader,create_user.username as creater "
                . "from inception_form,inception_service_line,admin_user as leader_user,"
                . "admin_user as create_user where inception_form.line_id=inception_service_line.line_id "
                . "and leader_user.user_id=inception_service_line.line_leader_id and "
                . "create_user.user_id=inception_form.user_id and (inception_form.user_id=? "
                . "or inception_service_line.line_leader_id=?) order by end_form_time";   
        //$query = $this->db->query($sql);
        $query = $this->db->query($sql,array($this->session->userdata('uid'),$this->session->userdata('uid')));
        //$query = $this->db->get(); 
        if ($query->num_rows() > 0)
	{
            return $query->result_array();
	}
    }
    //单个与用户相关表单详情数据
    function get_form_info($form_id){
        $sql="select inception_service_line.line_description,"
                . "inception_form.form_id,inception_form.form_sql,"
                . "inception_form.audit_result,inception_form.execute_result,inception_form.end_form_time,"
                . "inception_form.form_description,inception_form.form_status,"
                . "inception_form.create_time,inception_form.approve_time,"
                . "inception_form.excute_time,leader_user.username as leader,"
                . "create_user.username as creater from inception_form,"
                . "inception_service_line,admin_user as leader_user,admin_user "
                . "as create_user where inception_form.line_id=inception_service_line.line_id "
                . "and leader_user.user_id=inception_service_line.line_leader_id and "
                . "create_user.user_id=inception_form.user_id and inception_form.form_id=? "
                . "and (inception_form.user_id=? or inception_service_line.line_leader_id=?) ";
        $query = $this->db->query($sql,array($form_id,$this->session->userdata('uid'),$this->session->userdata('uid')));
        if ($query->num_rows() > 0)
	{
            return $query->result_array();
	}
    }
    //表单状态修改
    function change_form_status($form_id,$status){
        $sql='update inception_form set form_status=? where form_id=?;';
        $query = $this->db->query($sql,array($status,$form_id));
    }
    //表单审批时间添加
    function form_approve_time($form_id){
        $sql='update inception_form set approve_time=CURRENT_TIMESTAMP where form_id=?;';
        $query = $this->db->query($sql,array($form_id));
    }
    //表单执行时间添加
    function form_excute_time($form_id){
        $sql='update inception_form set excute_time=CURRENT_TIMESTAMP where form_id=?;';
        $query = $this->db->query($sql,array($form_id));
    }
    //取出表单用户信息【用于修改表单状态时的权限鉴定】
    function get_form_status($form_id){
        $sql='select inception_form.form_status,inception_form.form_sql,inception_form.user_id as creater_id,'
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
    function add_form_audit($audit_result,$form_id){
        $sql='update inception_form set audit_result=? where form_id=?';
        $query = $this->db->query($sql,array($audit_result,$form_id));
    }
    function add_form_execute($execute_result,$form_id){
      $sql='update inception_form set execute_result=? where form_id=?';
      $query = $this->db->query($sql,array($execute_result,$form_id));
    }
    //取出所有用户相关的业务线【用户表单业务线选项使用】
    function get_service_line(){
        $sql='select inception_service_line.line_id,inception_service_line.line_description from '
                . 'inception_service_line,inception_user_line where inception_service_line.line_status=1 and '
                . '((inception_service_line.line_id=inception_user_line.line_id '
                . 'and  inception_user_line.user_id=?) or (inception_service_line.line_leader_id=?)) group by line_id';
        $query = $this->db->query($sql,array($this->session->userdata['uid'],$this->session->userdata['uid']));
        if ($query->num_rows() > 0)
	{
            //return $query->row(0);
            return $query->result_array();
	}
    }
    //添加表单
    function add_inception_form($data){
        
        $sql='insert into inception_form (form_sql,form_description,form_status,user_id,line_id,end_form_time) values (?,?,?,?,?,?)';
        $query = $this->db->query($sql,$data);
    }
    //业务线数据【展示业务线使用】
    function show_service_line(){
        $sql='select inception_service_line.line_id,inception_service_line.line_description,'
                . 'inception_service_line.line_db_ip,inception_service_line.line_db_port,'
                . 'admin_user.username as leader from inception_service_line,admin_user where '
                . 'admin_user.user_id=inception_service_line.line_leader_id and inception_service_line.line_status=1';
        //$sql='select inception_service_line.line_id,inception_service_line.line_description,admin_user.username as'
        //        . ' leader from inception_service_line,admin_user where admin_user.user_id=inception_service_line.line_leader_id ';
    
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
	{
            //return $query->row(0);
            $result['datacount']=$query->num_rows();
            $result['datalist']=$query->result_array();
            return $result;
	}
    }
    function get_all_user(){
        $sql='select user_id,username from admin_user';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
	{
            //return $query->row(0);
            return $query->result_array();
	}
    }
    //添加业务线
    function add_inception_service_line($data){
        $sql='insert into inception_service_line (line_description,line_leader_id,line_db_ip,line_db_port,'
                . 'line_db_user,line_db_pwd) values (?,?,?,?,?,?)';
        $query = $this->db->query($sql,$data);
    }
    //取出单一业务线所有数据【修改业务线使用】
    function get_line_info($line_id){
        $sql='select inception_service_line.line_id,inception_service_line.line_description,'
                . 'inception_service_line.line_db_ip,inception_service_line.line_db_port,'
                . 'inception_service_line.line_db_user,inception_service_line.line_db_pwd'
                . ',admin_user.username as leader from inception_service_line,admin_user where '
                . 'admin_user.user_id=inception_service_line.line_leader_id and '
                . 'inception_service_line.line_status=1 and inception_service_line.line_id=?';
        $query = $this->db->query($sql,array($line_id));
        if ($query->num_rows() > 0)
	{
            //return $query->row(0);
            return $query->result_array();
	} 
    }
    //修改业务线数据
    function edit_inception_service_line($data){
        $sql='update inception_service_line set line_description=?,line_leader_id=?,'
                . 'line_db_ip=?,line_db_port=?,line_db_user=?,line_db_pwd=? where line_id=?';
        $query = $this->db->query($sql,$data);
    }
    //删除业务线【实际只是把line_status标识为0】
    function delete_inception_service_line($line_id){
        $sql='update inception_service_line set line_status=0 where line_id=?';
        $query = $this->db->query($sql,array($line_id));
    }
    //查找业务线所有人【修改业务线人员使用】
    function get_line_user($line_id){
        $sql='select user_id from inception_user_line where line_id=?';
        $query = $this->db->query($sql,array($line_id));
        if ($query->num_rows() > 0)
	{
            return $query->result_array();
	}
    }
    //修改业务线人员
    function update_line_user($line_id,$data){
        $sql='delete from inception_user_line where line_id=?';
        $query = $this->db->query($sql,array($line_id));
        $sql='insert into inception_user_line (line_id,user_id) values (?,?)';
        foreach ( $data as $value) {
            $query = $this->db->query($sql,array($line_id,$value));
        }
    }  
}
?>

