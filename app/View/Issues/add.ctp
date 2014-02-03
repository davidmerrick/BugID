<div class="issues form">
<?php echo $this->Form->create('Issue', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Issue'); ?></legend>
	<?php
		echo $this->Form->input('issue_publication_id', array('options' => $issuePublications));
		echo $this->Form->input('issue_number');
		echo $this->Form->input('issue_date_publication');
		echo $this->Form->input('issue_cover', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Issues'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Issue Publications'), array('controller' => 'issue_publications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue Publication'), array('controller' => 'issue_publications', 'action' => 'add')); ?> </li>
	</ul>
</div>
