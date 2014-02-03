<div class="publications form">
<?php echo $this->Form->create('Publication'); ?>
	<fieldset>
		<legend><?php echo __('Edit Publication'); ?></legend>
	<?php
		echo $this->Form->input('publication_id');
		echo $this->Form->input('publication_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Publication.publication_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Publication.publication_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Publications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Publication Issues'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
