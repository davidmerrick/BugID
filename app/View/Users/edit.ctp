<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Edit User'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        
        //Default user should be author
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'author' => 'Author'), 'default' => 'author'));
?>
    </fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>