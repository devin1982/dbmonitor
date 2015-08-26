<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="header">
            
            <h1 class="page-title"><?php echo $this->lang->line('inception'); ?> <?php echo $this->lang->line('_Form list'); ?></h1>
</div>
        
<ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('inception'); ?></li><span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_Form list'); ?></li>
            
</ul>

<div class="container-fluid">
<div class="row-fluid">
 
<script src="lib/bootstrap/js/bootstrap-switch.js"></script>
<link href="lib/bootstrap/css/bootstrap-switch.css" rel="stylesheet"/>
                    
<!--div class="ui-state-default ui-corner-all" style="height: 45px;" >
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-search"></span>                 
<form name="form" class="form-inline" method="get" action="<?php echo site_url('lp_mysql/index') ?>" >
   <input type="hidden" name="search" value="submit" />

 <input type="text" id="host"  name="host" value="<?php echo $setval['host']; ?>" placeholder="<?php echo $this->lang->line('please_input_host'); ?>" class="input-medium" >
 <input type="text" id="tags"  name="tags" value="<?php echo $setval['tags']; ?>" placeholder="<?php echo $this->lang->line('please_input_tags'); ?>" class="input-medium" >
  
  <select name="threads_connected" class="input-small" style="width: 120px;">
  <option value=""><?php echo $this->lang->line('threads_connected'); ?></option>
  <option value="50" <?php if($setval['threads_connected']=='50') echo "selected"; ?> >> 50</option>
  <option value="100" <?php if($setval['threads_connected']=='100') echo "selected"; ?> >> 100</option>
  <option value="300" <?php if($setval['threads_connected']=='300') echo "selected"; ?> >> 300</option>
  <option value="500" <?php if($setval['threads_connected']=='500') echo "selected"; ?> >> 500</option>
  <option value="1000" <?php if($setval['threads_connected']=='1000') echo "selected"; ?> >> 1000</option>
  <option value="2000" <?php if($setval['threads_connected']=='2000') echo "selected"; ?> >> 2000</option>
  <option value="3000" <?php if($setval['threads_connected']=='3000') echo "selected"; ?> >> 3000</option>
  <option value="5000" <?php if($setval['threads_connected']=='5000') echo "selected"; ?> >> 5000</option>
  </select>
  <select name="threads_running" class="input-small" style="width: 120px;">
  <option value=""><?php echo $this->lang->line('threads_running'); ?></option>
  <option value="5" <?php if($setval['threads_running']=='5') echo "selected"; ?> >> 5</option>
  <option value="10" <?php if($setval['threads_running']=='10') echo "selected"; ?> >> 10</option>
  <option value="20" <?php if($setval['threads_running']=='20') echo "selected"; ?> >> 20</option>
  <option value="30" <?php if($setval['threads_running']=='30') echo "selected"; ?> >> 30</option>
  <option value="50" <?php if($setval['threads_running']=='50') echo "selected"; ?> >> 50</option>
  <option value="100" <?php if($setval['threads_running']=='100') echo "selected"; ?> >> 100</option>
  </select>
  
  <select name="order" class="input-small" style="width: 100px;">
  <option value=""><?php echo $this->lang->line('sort'); ?></option>
  <option value="id" <?php if($setval['order']=='id') echo "selected"; ?> ><?php echo $this->lang->line('default'); ?></option>
  <option value="host" <?php if($setval['order']=='host') echo "selected"; ?> ><?php echo $this->lang->line('host'); ?></option>
  <option value="uptime" <?php if($setval['order']=='uptime') echo "selected"; ?> ><?php echo $this->lang->line('uptime'); ?></option>
  <option value="threads_running" <?php if($setval['order']=='threads_running') echo "selected"; ?> ><?php echo $this->lang->line('threads_running'); ?></option>
  <option value="threads_connected" <?php if($setval['order']=='threads_connected') echo "selected"; ?> ><?php echo $this->lang->line('threads_connected'); ?></option>
  <option value="queries_persecond" <?php if($setval['order']=='queries_persecond') echo "selected"; ?> ><?php echo $this->lang->line('qps'); ?></option>
  <option value="transaction_persecond" <?php if($setval['order']=='transaction_persecond') echo "selected"; ?> ><?php echo $this->lang->line('tps'); ?></option>

  </select>
  <select name="order_type" class="input-small" style="width: 70px;">
  <option value="asc" <?php if($setval['order_type']=='asc') echo "selected"; ?> ><?php echo $this->lang->line('asc'); ?></option>
  <option value="desc" <?php if($setval['order_type']=='desc') echo "selected"; ?> ><?php echo $this->lang->line('desc'); ?></option>
  </select>

  <button type="submit" class="btn btn-success"><i class="icon-search"></i> <?php echo $this->lang->line('search'); ?></button>
  <a href="<?php echo site_url('lp_mysql/index') ?>" class="btn btn-warning"><i class="icon-repeat"></i> <?php echo $this->lang->line('reset'); ?></a>
  <button id="refresh" class="btn btn-info"><i class="icon-refresh"></i> <?php echo $this->lang->line('refresh'); ?></button>
</form>                
</div-->
<div class="btn-toolbar">
    <a class="btn btn-primary " href="<?php echo site_url('inception/create') ?>"><i class="icon-plus"></i> <?php echo $this->lang->line('add'); ?></a>
    <!--a class="btn btn-primary " href="<?php echo site_url('servers_mysql/batch_add') ?>"><i class="icon-plus"></i> <?php echo $this->lang->line('batch_add'); ?></a>
    <a class="btn btn " href="<?php echo site_url('servers_mysql/trash') ?>"><i class="icon-trash"></i> <?php echo $this->lang->line('trash'); ?></a-->
  <div class="btn-group"></div>
</div>


<div class="well">
    <table class="table table-hover table-bordered ">
      <thead>
        <!--tr style="font-size: 12px;">
		<th colspan="2"><center><?php echo $this->lang->line('servers'); ?></center></th>
        <th colspan="4"><center><?php echo $this->lang->line('basic_info'); ?></center></th>
		<th colspan="3"><center><?php echo $this->lang->line('thread'); ?></center></th>
		<th colspan="2"><center><?php echo $this->lang->line('network'); ?></center></th>
		<th colspan="2"><center><?php echo $this->lang->line('query'); ?></center></th>
        <th ></th>
	   </tr-->
        <tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('line_description');?></th> 
        <th><?php echo $this->lang->line('form_sql'); ?></th> 
	<th><?php echo $this->lang->line('form_description'); ?></th>
        <th><?php echo $this->lang->line('create_time'); ?></th>
        <th><?php echo $this->lang->line('creater'); ?></th>
	<th><?php echo $this->lang->line('form_status'); ?></th>
	<th><?php echo $this->lang->line('leader'); ?></th>
        <th><?php echo $this->lang->line('approve_time'); ?></th>
        <th><?php echo $this->lang->line('excute_time'); ?></th>
        <th><?php echo $this->lang->line('form_detail'); ?></th>
	    </tr>
      </thead>
      <tbody>
         
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 12px;">
        <td><?php echo $item['line_description']?></td>
	<td data-toggle="tooltip" data-placement="left" title="<?php echo $item['form_sql'] ?>">SQL内容</td>
        <td data-toggle="tooltip" data-placement="left" title="<?php echo $item['form_description'] ?>">具体原因</td>
        <td><?php echo $item['create_time'] ?></td>
        <td><?php echo $item['creater'] ?></td>
        <td>
            <?php switch ($item['form_status']) {
            case 1: 
                echo "审批中...";
                break;
            case 2:
                echo "SQL审核中...";
                break;
            case 3:
                echo "请执行SQL";
                break;
            case 11:
                echo "审批禁止上线";
                break;
            case 12:
                echo "SQL审核未通过";
                break;
            case 13:
                echo "SQL执行遇到未知错误";
                break;
            default:
                echo "表单情况未知,请联系DBA";               
        } 
        ?></td>
        <td><?php echo $item['leader'] ?></td>
        <td><?php echo $item['approve_time'] ?></td>
        <td><?php echo $item['excute_time'] ?></td>
        <td><a href="<?php echo site_url('inception/status/'.$item['form_id']) ?>"  title="<?php echo $this->lang->line('form_in'); ?>" >&nbsp;&nbsp;&nbsp;<i class=" icon-list-alt"></i></a></td>
       
        <!--
	<td><?php if($item['connect']=='1'){ ?> <span class="label label-success"><?php echo $this->lang->line('success'); ?></span> <?php }else{  ?><span class="label label-important"><?php echo $this->lang->line('failure'); ?></span> <?php } ?></td>
        <td><?php echo check_value($item['role'])?></td>
        <td><?php echo check_uptime($item['uptime']) ?></td>
        <td><?php echo check_value($item['version']) ?></td>
        <td><?php echo check_connections(check_value($item['threads_connected'])) ?></td>
        <td><?php echo check_active(check_value($item['threads_running'])) ?></td>
        <td><?php echo check_active(check_value($item['threads_waits'])) ?></td>
        <td><?php echo format_kbytes($item['bytes_received_persecond']) ?></td>
        <td><?php echo format_kbytes($item['bytes_sent_persecond']) ?></td>
        <td><?php echo check_value($item['queries_persecond']) ?></td>
        <td><?php echo check_value($item['transaction_persecond']) ?></td>
        <td><?php if($item['connect']=='1'){ ?><a href="<?php echo site_url('lp_mysql/chart/'.$item['server_id']) ?>"><img src="./images/chart.gif"/></a> <?php }else{  ?>--- <?php } ?></td>
        -->
	</tr>
 <?php endforeach;?>
 <?php }else{  ?>
        
<tr>
<td colspan="12">
<font color="red"><?php echo $this->lang->line('no_record'); ?></font>
</td>
</tr>
<?php } ?>      
      </tbody>
    </table>
</div>

 </script>



