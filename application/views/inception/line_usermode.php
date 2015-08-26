<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="header">          
            <h1 class="page-title"><?php echo $this->lang->line('inception'); ?> <?php echo $this->lang->line('_Line list'); ?></h1>
</div>
        
<ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('inception'); ?></li><span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('line_user'); ?></li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">
        <?php echo validation_errors()?>
        <?php if(!empty($linelist)) {?>
       <?php foreach ($linelist  as $item):?>
        <form name="form" class="form-horizontal" method="post" action="<?php echo site_url('inception/line_usermode/'.$item['line_id']) ?>" >
       <?php endforeach;}?>
            <input type="hidden" name="submit" value="usermode"/> 
            <div class="btn-toolbar">
                <button type="submit" class="btn btn-primary"><i class="icon-save"></i> <?php echo $this->lang->line('save'); ?></button>
                <a class="btn btn " href="<?php echo site_url('inception/line_list') ?>"><i class="icon-list"></i> <?php echo $this->lang->line('list'); ?></a>
                <div class="btn-group"></div>
            </div>
            <div class="well"> 
                <?php if(!empty($linelist)) {?>
                <?php foreach ($linelist  as $item):?>
                    <center><?php echo $item['line_description']?></center><hr>
                <?php endforeach;}?>
                   
                <div class="control-group">
                    <label class="control-label" for=""><?php echo $this->lang->line('line_user_mode'); ?></label>
                    <?php if(!empty($userlist)) {?>
                    <?php foreach ($userlist  as $item):?>
                    <div class="controls">                                                   
                            <input type="checkbox" name="users[]" value="<?php echo $item['user_id']; ?>" <?php if (in_array($item['user_id'],$lineusers)){?>checked="checked" <?php } ?> ><?php echo $item['username']; ?>
                    </div>
                    <?php endforeach;} ?> 
                </div>
            </div>   
        </form>
    </div>
</div>
