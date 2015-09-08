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
 
<div class="btn-toolbar">
  <div class="btn-group"></div>
</div>

<div class="well">
 
    <table class="table table-hover table-bordered ">
        <caption>
           表单详细情况<hr/>
           <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
        <div class="flow_steps">
            <ul id="stepbar">
                <li id="step_1">第一步： 提交表单</li>
                <li id="step_2">第二步： SQL审核</li>
                <li id="step_3">第三步： 负责人审批</li>
                <li id="step_4">第四步： SQL执行上线</li>
                <li id="step_5" class="last">完成</li>
            </ul>
            <br/>
            <style>
                .flow_steps ul li { list-style-type:none; float:left; height:23px; padding:0 40px 0 30px; line-height:23px; text-align:center; background:url(lib/progress.png) no-repeat 100% 0 #E4E4E4; font-weight:bold;}
                .flow_steps ul li.done { list-style-type:none; background-position:100% -46px; background-color:#FFEDA2;}
                .flow_steps ul li.current_prev { list-style-type:none; background-position:100% -23px; background-color:#FFEDA2;}
                .flow_steps ul li.current { list-style-type:none; color:#fff; background-color:#990D1B;}
                .flow_steps ul li.last { list-style-type:none; background-image:none;} 
            </style>  
        </div>
        <script>
       $.fn.extend({'setStep':function(n){
               $(this).children("li").each(function(){
                   if (($(this).index()+2)<n){
                       $(this).addClass("done");
                   }else if (($(this).index()+2)==n){
                       $(this).addClass("current_prev");
                   } else if (($(this).index()+1)==n){
                       $(this).addClass("current");
                   }                  
               });
       }});     

    <?php switch ($item['form_status']) {
            case 1: 
                echo "$(\"#stepbar\").setStep(1);";
                break;
            case 2:
                echo "$(\"#stepbar\").setStep(2);";
                break;
            case 3:
                echo "$(\"#stepbar\").setStep(4);";
                break;
            case 11:
                echo "$(\"#stepbar\").setStep(2);";
                break;
            case 12:
                echo "$(\"#stepbar\").setStep(3);";
                break;
            case 13:
                echo "$(\"#stepbar\").setStep(4);";
                break;
            case 0:
                echo "$(\"#stepbar\").setStep(5);";
                break;             
        } 
        ?>
  </script>
<?php endforeach;}?> </br>
        </caption>

      <tbody>
         
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('line_description');?></th>
        <td><?php echo $item['line_description']?></td>
    </tr><tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('form_sql'); ?></th>
        <td><?php echo $item['form_sql'] ?></td>
    </tr><tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('form_description'); ?></th>
        <td><?php echo $item['form_description'] ?></td>
    </tr><tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('create_time'); ?></th>
        <td><?php echo $item['create_time'] ?></td>
    </tr><tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('creater'); ?></th>
        <td><?php echo $item['creater'] ?></td>
    </tr><tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('end_form_time'); ?></th>
        <td><?php echo $item['end_form_time'] ?></td>
    </tr><tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('form_status'); ?></th>
        <td>
            <?php switch ($item['form_status']) {
            case 0:
                echo "执行完毕";
                break;
            case 1: 
                echo "SQL等待审核";
                break;
                
            case 2:
                
                if ($item['leader'] == $this->session->userdata('username') && $item['creater'] != $this->session->userdata('username')){
                echo "请您审批";
                } else {
                echo "等待审批";
                }
                break;
            case 3:               
                    echo "等待上线";              
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
    </tr><tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('leader'); ?></th>
        <td><?php echo $item['leader'] ?></td>
    </tr><tr style="font-size: 12px;">
         <th><?php echo $this->lang->line('approve_time'); ?></th>
        <td><?php echo $item['approve_time'] ?></td>
    </tr><tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('excute_time'); ?></th>
        <td><?php echo $item['excute_time'] ?></td>
    </tr>

        
        
        <tr>
            
            </td>
            <td colspan="2">
                <?php switch ($item['form_status']) {
            case 0:
                echo "成功上线";
                break;
            case 1: 
                if ($item['leader'] == $this->session->userdata('username') && $item['creater'] != $this->session->userdata('username')){
                    echo "请提交审核";
                } else {?>
                    <div class="btn-toolbar">
                    <a class="btn btn-primary " href="<?php echo site_url('inception/status/'.$item['form_id'].'/audit_yes/') ?>"><?php echo $this->lang->line('audit_yes'); ?></a>                   
                    </div>
                <?php }
                break;
            case 2:
                
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
                if ($item['leader'] == $this->session->userdata('username') && $item['creater'] != $this->session->userdata('username')){
                    echo "未通过审核";
                } else {?>
                    <div class="btn-toolbar">
                    <a class="btn btn-primary " href="<?php echo site_url('inception/create/'.$item['form_id']) ?>"><?php echo $this->lang->line('edit_sql'); ?></a>                   
                    </div>
                <?php }
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
<?php if(!empty($datalist)) {?>
<?php foreach ($datalist  as $item): ?>
    <div class="btn btn-large btn-block btn-default" id="audit">
    <?php if(!empty($item['audit_result'])){?>
           表单SQL审核结果
           
    <?php } else { ?>
            表单SQL尚未进行审核
    <?php }?>
        </div>
    <table class="table table-hover table-bordered ">
        
        <tbody id="audit_result">
            <?php if (!empty($item['audit_result'])) { 
                $audit_list = json_decode(stripslashes($item['audit_result']),TRUE);
                for ($i=1;$i<=count($audit_list);$i++){
                    echo '<tr class=\'info\' style="font-size: 12px;"><th class=\'info\'>ID</th><td>';
                        print($audit_list[$i]["ID"]);
                    echo '</td></tr>';
                    
                    echo '<tr style="font-size: 12px;"><th>SQL</th><td>';
                        print($audit_list[$i]["SQL"]);
                    echo '</td></tr>';
                    
                    echo '<tr style="font-size: 12px;"><th>错误信息</th><td>';
                        print($audit_list[$i]["errormessage"]);
                    echo '</td></tr>';
                    
                    echo '<tr style="font-size: 12px;"><th>审核状态</th><td>';
                        print($audit_list[$i]["stagestatus"]);
                    echo '</td></tr>';
                    echo '<tr><th>变更行数</th><td>';
                        print($audit_list[$i]["Affected_rows"]);
                    echo '</td></tr>';
                }
            
            ?>
        </tbody>
    </table>
    <script>
        $("#audit_result").hide();
        $("#audit").click(function(){$("#audit_result").toggle();});
    </script>
    
    <?php 
        $erro_tg=0;
        for ($i=1;$i<=count($audit_list);$i++){            
            if ($audit_list[$i]["errlevel"] >0 ) {
                $erro_tg=1;
            }           
        }
        if ( $erro_tg==1){ ?>
               
           
 <div class="btn btn-large btn-block btn-default" id="audit_faild">
     错误SQL列表  
</div>
    <table class="table table-hover table-bordered ">
        
        <tbody id="audit_faild_tg">
            <?php 
            for ($i=1;$i<=count($audit_list);$i++){                   
                if ($audit_list[$i]['errlevel']>0){
                    echo '<tr class=\'info\' style="font-size: 12px;"><th class=\'info\'>ID</th><td>';
                        print($audit_list[$i]["ID"]);
                    echo '</td></tr>';                   
                    echo '<tr style="font-size: 12px;"><th>SQL</th><td>';
                        print($audit_list[$i]["SQL"]);
                    echo '</td></tr>';
                    
                    echo '<tr style="font-size: 12px;"><th>错误信息</th><td>';
                        print($audit_list[$i]["errormessage"]);
                    echo '</td></tr>';
                    
                    echo '<!--tr><th>变更行数</th><td>';
                        print($audit_list[$i]["Affected_rows"]);
                    echo '</td></tr-->';
                }
            }
            ?>
        </tbody>
    </table>
    <script>
        $("#audit_faild_tg").hide();
        $("#audit_faild").click(function(){$("#audit_faild_tg").toggle();});
    </script>
    <?php } 
    }
        endforeach;    
                } 
                ?>

<?php if(!empty($datalist)) { ?>
<?php foreach ($datalist  as $item): ?>
            <div class="btn btn-large btn-block btn-default" id="execute">
            <?php if (!empty($item['execute_result'])){ ?>
           表单SQL执行结果
            <?php } else { ?>
            表单SQL尚未执行
            <?php } ?>
        </div>
    <table class="table table-hover table-bordered ">

        <tbody id="execute_result">
        <?php if(!empty($item['execute_result'])){
            $execute_list = json_decode(stripslashes($item['execute_result']),TRUE); 
                for ($i=1;$i<=count($audit_list);$i++){
                    echo '<tr class=\'info\' style="font-size: 12px;"><th>ID</th><td>';
                        print($execute_list[$i]["ID"]);
                    echo '</td></tr>';
                    
                    echo '<tr style="font-size: 12px;"><th>SQL</th><td>';
                        print($execute_list[$i]["SQL"]);
                    echo '</td></tr>';
                    
                    echo '<tr style="font-size: 12px;"><th>错误信息</th><td>';
                        print($execute_list[$i]["errormessage"]);
                    echo '</td></tr>';
                    
                    echo '<tr style="font-size: 12px;"><th>执行状态</th><td>';
                        print($execute_list[$i]["stagestatus"]);
                    echo '</td></tr>';
                    
                    echo '<tr style="font-size: 12px;"><th>备份DB</th><td>';
                        print($execute_list[$i]["backup_dbname"]);
                    echo '</td></tr>';
                    
                    echo '<tr style="font-size: 12px;"><th>序列号</th><td>';
                        print($execute_list[$i]["sequence"]);
                    echo '</td></tr>';
                    
                    echo '<tr style="font-size: 12px;"><th>变更行数</th><td>';
                        print($execute_list[$i]["Affected_rows"]);
                    echo '</td></tr>';
                }
        } ?>
        </tbody>
    </table>

    <script>
        $("#execute_result").hide();
        $("#execute").click(function(){$("#execute_result").toggle();});
    </script>
<?php endforeach ; } ?>
</div>
 </script>



