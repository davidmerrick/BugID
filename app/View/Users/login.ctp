<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your e-mail address and password'); ?>
        </legend>
        <?php 
        echo $this->Form->input('username', array('label' => 'E-mail address'));
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
<?php echo $this->Html->link(__('Register for an account'), array('action' => 'add')); ?></li>
</div>