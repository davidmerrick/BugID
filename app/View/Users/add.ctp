<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('New User'); ?></legend>
        <?php 
        echo $this->Form->input('first_name');
        echo $this->Form->input('last_name');
        echo $this->Form->input('university', array('label' => 'University Affiliation'));
        echo $this->Form->input('username', array('label' => 'E-mail address'));
        echo $this->Form->input('nickname', array('label' => 'Username'));
        echo $this->Form->input('password');
        echo $this->Form->input('repass', array('label' => 'Confirm password', 'type' => 'password'));
        //Default user should be author
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'author' => 'Author'), 'default' => 'author'));
?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php echo $this->Element('sidebar_users'); ?>