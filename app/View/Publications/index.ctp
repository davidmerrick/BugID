<div class="publications index">
	<h2><?php echo __('Publications'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('publication_id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('publication_name', __('Name')); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($publications as $publication): ?>
	<tr>
		<td><?php echo h($publication['Publication']['publication_id']); ?>&nbsp;</td>
		<td><?php echo h($publication['Publication']['publication_name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $publication['Publication']['publication_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $publication['Publication']['publication_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $publication['Publication']['publication_id']), null, __('Are you sure you want to delete # %s?', $publication['Publication']['publication_id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Publication'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Publication Issues'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
