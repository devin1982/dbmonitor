<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="header">
            
            <h1 class="page-title"><?php echo $this->lang->line('inception'); ?> <?php echo $this->lang->line('_Form status'); ?></h1>
</div>
        
<ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('inception'); ?></li><span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_Form status'); ?></li>
            
</ul>

<div class="container-fluid">
<div class="row-fluid">
 
<script src="lib/bootstrap/js/bootstrap-switch.js"></script>
<link href="lib/bootstrap/css/bootstrap-switch.css" rel="stylesheet"/>
                    

<div class="btn-toolbar">
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
	<th><?php echo $this->lang->line('form_status'); ?></th>
	<th><?php echo $this->lang->line('leader'); ?></th>
        <th><?php echo $this->lang->line('approve_time'); ?></th>
        <th><?php echo $this->lang->line('excute_time'); ?></th>
	</tr>
      </thead>
      <tbody>
         
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 12px;">
        <td><?php echo $item['line_description']?></td>
	<td><?php echo $item['form_sql'] ?></td>
        <td><?php echo $item['form_description'] ?></td>
        <td><?php echo $item['create_time'] ?></td>
        <td><?php echo $item['creater'] ?></td>
        <td>
            <?php switch ($item['form_status']) {
            case 1: 
                if ($item['leader'] == $this->session->userdata('username')){
                echo "请您审批中...";
                } else {
                echo "审批中...";
                }
                break;
            case 2:
                 echo "SQL审核中...";
                break;
            case 3:               
                    echo "等待上线...";              
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
	</tr>
        <link href="lib/ystep/css/ystep.css" rel="stylesheet"/>
        <script src="lib/ystep/js/jquery.min.js"></script>
        <script src="lib/ystep/js/ystep.js"></script>
        
        
        <tr>
            
            </td>
            <td colspan="2">
                <?php switch ($item['form_status']) {
            case 0:
                echo "成功上线";
                break;
            case 1: 
                if ($item['leader'] == $this->session->userdata('username')){
                ?>
                <div class="btn-toolbar">
                <a class="btn btn-primary " href="<?php echo site_url('inception/status/'.$item['form_id'].'/approve_yes/') ?>"><?php echo $this->lang->line('approve_yes'); ?></a>
                <a class="btn btn-primary " href="<?php echo site_url('inception/status/'.$item['form_id']).'/approve_no/' ?>"><?php echo $this->lang->line('approve_no'); ?></a>
                </div>
                   <?php
                } else {
                echo "等待审批中...";
                }
                break;
            case 2:
                echo "审批通过，系统自动审核中...";
                break;
            case 3:
                ?>
                <div class="btn-toolbar">
                <a class="btn btn-primary " href="<?php echo site_url('inception/status/'.$item['form_id'].'/excute_yes/') ?>"><?php echo $this->lang->line('excute_yes'); ?></a>
                <a class="btn btn-primary " href="<?php echo site_url('inception/status/'.$item['form_id'].'/excute_no/') ?>"><?php echo $this->lang->line('excute_no'); ?></a>
                </div>
                    <?php
                break;
            case 11:
                echo "审批禁止上线";
                break;
            case 12:
                echo "SQL审核未通过";
                break;
            case 13:
                echo "SQL已被终止执行";
                break;
            case 14:
                echo "SQL执行遇到未知错误";
                break;
            default:
                echo "表单情况未知,请联系DBA";               
        } 
        ?>
            </td>
            <td colspan="7">
        <div class="ystep1"></div>
        <script>
    //根据jQuery选择器找到需要加载ystep的容器
    //loadStep 方法可以初始化ystep
    $(".ystep1").loadStep({
      //ystep的外观大小
      //可选值：small,large
      size: "small",
      //ystep配色方案
      //可选值：green,blue
      color: "green",
      //ystep中包含的步骤
      steps: [{
        //步骤名称
        title: "提交",
        //步骤内容(鼠标移动到本步骤节点时，会提示该内容)
        content: "提交SQL上线流程"
      },{
        title: "审批",
        content: "业务负责人审批"
      },{
        title: "审核",
        content: "进入自动SQL审核中心，进行智能审核"
      },{
        title: "执行",
        content: "执行SQL"
      },{
        title: "结束",
        content: "SQL上线处理完毕"
      }]
    });
    <?php switch ($item['form_status']) {
            case 1: 
                echo "$(\".ystep1\").setStep(1);";
                break;
            case 2:
                echo "$(\".ystep1\").setStep(2);";
                break;
            case 3:
                echo "$(\".ystep1\").setStep(4);";
                break;
            case 11:
                echo "$(\".ystep1\").setStep(2);";
                break;
            case 12:
                echo "$(\".ystep1\").setStep(3);";
                break;
            case 13:
                echo "$(\".ystep1\").setStep(4);";
                break;
            case 0:
                echo "$(\".ystep1\").setStep(5);";
                break;             
        } 
        ?>
  </script>
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

 <script type="text/javascript">
    $('#refresh').click(function(){
        document.location.reload(); 
    })
 </script>



