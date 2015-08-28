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
<div class="btn-toolbar">
    <a class="btn btn-primary " href="<?php echo site_url('inception/create') ?>"><i class="icon-plus"></i> <?php echo $this->lang->line('add'); ?></a>
  <div class="btn-group"></div>
</div>


<div class="well">
    <table class="table table-hover table-bordered ">
      <thead>
        <tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('line_description');?></th> 
        <th><?php echo $this->lang->line('form_sql'); ?></th> 
	<th><?php echo $this->lang->line('form_description'); ?></th>
        <th><?php echo $this->lang->line('create_time'); ?></th>
        <th><?php echo $this->lang->line('creater'); ?></th>
        <th><?php echo $this->lang->line('end_form_time'); ?></th>
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
	<td data-toggle="popver" data-placement="right" title="<?php echo $item['form_sql'] ?>" data-content="<?php echo $item['form_sql']?>">SQL内容</td>
        <td data-toggle="tooltip" data-placement="left" title="<?php echo $item['form_description'] ?>">具体原因</td>
        <td><?php echo $item['create_time'] ?></td>
        <td><?php echo $item['creater'] ?></td>
        <td><?php echo $item['end_form_time'] ?></td>
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



