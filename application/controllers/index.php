<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Index extends Front_Controller {
    function __construct(){
		parent::__construct();
        $this->load->model("lepus_model","lepus"); 
	
	}
    public function index(){

        $mysql_statistics = array();
        $mysql_statistics["mysql_servers_up"] = $this->db->query("select count(*) as num from mysql_status where connect=1")->row()->num;
        $mysql_statistics["mysql_servers_down"] = $this->db->query("select count(*) as num from mysql_status  where connect!=1")->row()->num;
        $mysql_statistics["master_mysql_instance"] = $this->db->query("select count(*) as num from mysql_replication where is_master=1")->row()->num;
        $mysql_statistics["slave_mysql_instance"] = $this->db->query("select count(*) as num from mysql_replication where is_slave=1")->row()->num;

        $mysql_statistics["normal_mysql_replication"] = $this->db->query("select count(*) as num from mysql_replication where is_slave=1 and (slave_io_run='Yes' and slave_sql_run='Yes') ")->row()->num;
        $mysql_statistics["exception_mysql_replication"] = $this->db->query("select count(*) as num from mysql_replication where is_slave=1 and  (slave_io_run!='Yes' or slave_sql_run!='Yes') ")->row()->num;

        $data["mysql_statistics"] = $mysql_statistics;
        //print_r($mysql_statistics);
        $data["mysql_versions"] = $this->db->query("select version as versions, count(*) as num from mysql_status where version !='0' GROUP BY versions")->result_array();

        $data['mysql_qps_ranking'] = $this->db->query("select server.host,server.port,status.queries_persecond
        value from mysql_status status left join db_servers_mysql server
on `status`.server_id=`server`.id order by queries_persecond desc limit 10;")->result_array();
        $data['mysql_tps_ranking'] = $this->db->query("select server.host,server.port,status.transaction_persecond value from mysql_status status left join db_servers_mysql server
on `status`.server_id=`server`.id order by transaction_persecond desc limit 10;")->result_array();
        $data['mysql_threads_connected_ranking'] = $this->db->query("select server.host,server.port,status.threads_connected value from mysql_status status left join db_servers_mysql server
on `status`.server_id=`server`.id order by threads_connected desc limit 10;")->result_array();
        $data['mysql_threads_running_ranking'] = $this->db->query("select server.host,server.port,status.threads_running value from mysql_status status left join db_servers_mysql server
on `status`.server_id=`server`.id order by threads_running desc limit 10;")->result_array();
//print_r($data['mysql_thread_ranking']);

        $data['last_alarmlist'] = $this->db->query("select * from  alarm_history   order by create_time desc limit 8;")->result_array();

        $data["cur_nav"]="screen";

        $this->layoutfull->view("screen/index",$data);
    }    

    public function monlist(){
        //for mysql
        $mysql_statistics = array();
        $data["servers_mysql_count"] = $this->db->query("select count(*) as num from db_servers_mysql where is_delete=0")->row()->num;
		$data["servers_oracle_count"] = $this->db->query("select count(*) as num from db_servers_oracle where is_delete=0")->row()->num;
		$data["servers_mongodb_count"] = $this->db->query("select count(*) as num from db_servers_mongodb where is_delete=0")->row()->num;
		$data["servers_redis_count"] = $this->db->query("select count(*) as num from db_servers_redis where is_delete=0")->row()->num;
		$data["servers_os_count"] = $this->db->query("select count(*) as num from db_servers_os where is_delete=0")->row()->num;
        
        
		$lepus_status=$this->lepus->get_lepus_status();
        $data['lepus_status']=$lepus_status;
        
        $setval["host"]=isset($_GET["host"]) ? $_GET["host"] : "";
        $setval["tags"]=isset($_GET["tags"]) ? $_GET["tags"] : "";
        $setval["db_type"]=isset($_GET["db_type"]) ? $_GET["db_type"] : "";
        $setval["order"]=isset($_GET["order"]) ? $_GET["order"] : "";
        $setval["order_type"]=isset($_GET["order_type"]) ? $_GET["order_type"] : "";
        $data["setval"]=$setval;

        //$data['db_status'] = $this->db->query("select db_status.* from db_status where db_status.db_type in('mysql', 'oracle', 'mongodb', 'redis') order by db_status.db_type_sort asc,db_status.host asc, db_status.tags asc,db_status.role asc;")->result_array();
        $data['db_status'] = $this->lepus->get_db_status();
        
        $this->layout->view("index/index",$data);
    }
    

    
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
