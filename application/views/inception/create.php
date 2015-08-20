<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="header">          
            <h1 class="page-title"><?php echo $this->lang->line('inception'); ?> <?php echo $this->lang->line('_Form list'); ?></h1>
</div>
        
<ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('inception'); ?></li><span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_Form add'); ?></li>            
</ul>

<div class="container-fluid">
    <div class="row-fluid">
        <?php echo validation_errors()?>
        <form name="form" class="form-horizontal" method="post" action="<?php echo site_url('inception/create') ?>" >
            <input type="hidden" name="submit" value="add"/> 
            <div class="btn-toolbar">
                <button type="submit" class="btn btn-primary"><i class="icon-save"></i> <?php echo $this->lang->line('save'); ?></button>
                <a class="btn btn " href="<?php echo site_url('inception/index') ?>"><i class="icon-list"></i> <?php echo $this->lang->line('list'); ?></a>
                <div class="btn-group"></div>
            </div>




            <div class="well">

  
                <div class="control-group">
                    <label class="control-label" for="">*<?php echo $this->lang->line('line_description'); ?></label>
                    <div class="controls">
                        <select name="line_id" id="line_description" >
                            <option >请选择业务线</option>
                            <?php if(!empty($datalist)) {?>
                            <?php foreach ($datalist  as $item):?>
                                <option value="<?php echo $item['line_id']; ?>"  ><?php echo $item['line_description']; ?></option>
                            <?php endforeach;}?>
                        </select>
                    </div>
                </div>
   
                <div class="control-group">
                    <label class="control-label" for="">*<?php echo $this->lang->line('form_sql'); ?></label>
                    <div class="controls">
                        <textarea  rows="5" class="span8" name="form_sql"></textarea>
                        <span class="help-inline"></span>
                    </div>
                 </div>
   
                <div class="control-group">
                    <label class="control-label" for="">*<?php echo $this->lang->line('form_description'); ?></label>
                    <div class="controls">
                        <textarea rows="5" class="span8" name="form_description" ></textarea>
                        <span class="help-inline"></span>
                    </div>
                </div>
            </div>   
        </form>
    </div>
</div>
