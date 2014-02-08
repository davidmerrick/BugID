<div class="users form">
<h2><?php echo __('Reset your password'); ?></h2>
<?php
	echo $this->Form->create($model, array('url' => array('action' => 'reset_password', $token)));
	echo $this->Form->input('new_password', array('label' => __('New Password'), 'type' => 'password'));
	echo $this->Form->input('confirm_password', array('label' => __('Confirm'), 'type' => 'password'));
	echo $this->Form->submit(__('Submit'));
	echo $this->Form->end();
?>
</div>
<?php echo $this->element('Users/sidebar'); ?>