<div class="users form">
	<?php echo $this->Form->create($model); ?>
		<fieldset>
			<legend><?php echo __('Edit User'); ?></legend>
			<?php
				echo $this->Form->input('UserDetail.first_name');
				echo $this->Form->input('UserDetail.last_name');
                                echo $this->Form->input('UserDetail.university', array('label' => 'University Affiliation'));
			?>
			<p>
				<?php echo $this->Html->link(__('Change your password'), array('action' => 'change_password')); ?>
			</p>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php echo $this->element('Users/sidebar'); ?>