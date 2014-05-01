<div class="users index">
	<h2><?php echo __('Login'); ?></h2>
	<?php echo $this->Session->flash('auth');?>
	<fieldset>
		<?php
                        echo $this->Form->create($model, array('controller' => 'app_users', 'action' => 'login'));
			echo $this->Form->input('email', array('label' => __('Email')));
			echo $this->Form->input('password',  array('label' => __('Password')));
			echo '<p>' . $this->Form->input('remember_me', array('type' => 'checkbox', 'label' =>  __('Remember Me'))) . '</p>';
			echo '<p>' . $this->Html->link(__('I forgot my password'), array('controller' => 'app_users', 'action' => 'reset_password')) . '</p>';
			echo $this->Form->hidden('User.return_to', array('value' => $return_to));
			echo $this->Form->end(__('Submit'));
		?>
	</fieldset>
</div>
