<div class="bugs form">
<?php echo $this->Form->create('Bug', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Bug'); ?></legend>
	<?php
		echo $this->Form->input('bug_photo', array('type' => 'file'));
                
                //Set smallest bug size to 0 mm and largest to 800
                echo $this->Form->input('bug_size', array('label' => 'Bug Size (mm)', 'min' => '0', 'max' => '800'));
		echo $this->Form->input('specimen_code');
		echo $this->Form->input('lab_name');
		echo $this->Form->input('river');
		echo $this->Form->input('state');
		echo $this->Form->input('country');
		echo $this->Form->input('collector_name');
		echo $this->Form->input('researcher_name');
		echo $this->Form->input('latitude');
		echo $this->Form->input('longitude');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Bugs'), array('action' => 'index')); ?></li>
	</ul>
</div>