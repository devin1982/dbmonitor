<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="header">          
            <h1 class="page-title"><?php echo $this->lang->line('inception'); ?> <?php echo $this->lang->line('_Form list'); ?></h1>
</div>
        
<ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_Line list'); ?></li><span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_Line edit'); ?></li>            
</ul>

<div class="container-fluid">
    <div class="row-fluid">
        <?php echo validation_errors()?>
        <form name="form" class="form-horizontal" method="post" action="<?php echo site_url('inception/edit') ?>" >
            <input type="hidden" name="submit" value="edit"/> 
            <div class="btn-toolbar">
                <button type="submit" class="btn btn-primary"><i class="icon-save"></i> <?php echo $this->lang->line('save'); ?></button>
                <a class="btn btn " href="<?php echo site_url('inception/line_list') ?>"><i class="icon-list"></i> <?php echo $this->lang->line('list'); ?></a>
                <div class="btn-group"></div>
            </div>

            <div class="well">
                <?php if(!empty($datalist)) {?>
                            <?php foreach ($datalist  as $item):?>
                <input type="hidden" name="line_id" value="<?php echo $item['line_id']?>"/>
                <div class="control-group">
                    <label class="control-label" for="">*<?php echo $this->lang->line('line_description'); ?></label>
                    <div class="controls">
                        <input type="text" id=""  name="line_description" value="<?php echo $item['line_description']?>" >
                        <span class="help-inline"></span>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="">*<?php echo $this->lang->line('line_leader'); ?></label>
                    <div class="controls">
                        <select name="line_leader_id"  >
                            <option >请选择业务线负责人</option>
                            <?php if(!empty($userlist)) {?>
                            <?php foreach ($userlist  as $tem):?>
                                <option value="<?php echo $tem['user_id']; ?>" <?php if ($tem['username']==$item['leader']) {?> selected="selected" <?php }?>><?php echo $tem['username']; ?></option>
                            <?php endforeach;}?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="">*<?php echo $this->lang->line('line_db'); ?></label>
                    <div class="controls">
                        <input type="text" id=""  name="line_db_ip"  value="<?php echo $item['line_db_ip']?>">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="">*<?php echo $this->lang->line('port'); ?></label>
                    <div class="controls">
                        <input type="text" id=""  name="line_db_port"  value="<?php echo $item['line_db_port']?>">
                        <span class="help-inline"></span>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="">*<?php echo $this->lang->line('line_db_user'); ?></label>
                    <div class="controls">
                        <input type="text" id=""  name="line_db_user" value="<?php echo $item['line_db_user']?>"  >
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="">*<?php echo $this->lang->line('line_db_pwd'); ?></label>
                    <div class="controls">
                        <input type="password" id=""  name="line_db_pwd" value="<?php echo $item['line_db_pwd']?>" >
                        <span class="help-inline"></span>
                    </div>
                </div>
                <?php endforeach;}?>
            </div>   
        </form>
    </div>
</div>
