<div class="users form">
	<?php echo $this->Form->create($model); ?>
		<fieldset>
			<legend><?php echo __d('users', 'Edit User'); ?></legend>
			<?php
				echo $this->Form->input('UserDetail.first_name');
				echo $this->Form->input('UserDetail.last_name');
				echo $this->Form->input('UserDetail.birthday');
			?>
			<p>
				<?php echo $this->Html->link(__d('users', 'Change your password'), array('action' => 'change_password')); ?>
			</p>
		</fieldset>
	<?php echo $this->Form->end(__d('users', 'Submit')); ?>
</div>
<?php echo $this->element('Users.Users/sidebar'); ?>