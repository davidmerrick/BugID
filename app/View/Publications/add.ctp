<div class="publications form">
<?php echo $this->Form->create('Publication'); ?>
	<fieldset>
		<legend><?php echo __('Add Publication'); ?></legend>
	<?php
		echo $this->Form->input('publication_name', array('label' => __('Name of Publication')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Publications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Publication Issues'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
