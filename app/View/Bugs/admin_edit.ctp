<div class="bugs form">
<?php echo $this->Form->create('Bug'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Bug'); ?></legend>
	<?php
		echo $this->Form->input('bug_id');
		echo $this->Form->input('timestamp');
		echo $this->Form->input('bug_photo');
		echo $this->Form->input('bug_size');
		echo $this->Form->input('specimen_code');
		echo $this->Form->input('lab_name');
		echo $this->Form->input('river');
		echo $this->Form->input('state');
		echo $this->Form->input('country');
		echo $this->Form->input('collector_name');
		echo $this->Form->input('researcher_name');
		echo $this->Form->input('latitude');
		echo $this->Form->input('longitude');
		echo $this->Form->input('species_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Bug.bug_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Bug.bug_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Bugs'), array('action' => 'index')); ?></li>
	</ul>
</div>
