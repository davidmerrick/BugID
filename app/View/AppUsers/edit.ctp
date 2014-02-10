<div class="users form">
	<?php echo $this->Form->create($model, array('type' => 'file')); ?>
		<fieldset>
			<legend><?php echo __('Edit User'); ?></legend>
			<?php
                                if($this->data[$model]['profile_photo']){
                                    echo $this->Html->image($this->data[$model]['profile_photo'], array('class' => 'profile_photo'));
                                }
				echo $this->Form->input('profile_photo', array('type' => 'file', 'label' => 'Change Profile Photo'));
                                echo $this->Form->input('first_name');
				echo $this->Form->input('last_name');
                                echo $this->Form->input('university', array('label' => 'University Affiliation'));
			?>
			<p>
				<?php echo $this->Html->link(__('Change your password'), array('action' => 'change_password')); ?>
			</p>
		</fieldset>
	<?php echo $this->Form->end(__('Update')); ?>
</div>
<?php echo $this->element('Users/sidebar'); ?>