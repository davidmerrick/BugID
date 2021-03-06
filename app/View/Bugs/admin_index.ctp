<div class="bugs index">
	<h2><?php echo __('Bugs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('bug_id'); ?></th>
			<th><?php echo $this->Paginator->sort('timestamp'); ?></th>
			<th><?php echo $this->Paginator->sort('bug_photo'); ?></th>
			<th><?php echo $this->Paginator->sort('bug_size'); ?></th>
			<th><?php echo $this->Paginator->sort('specimen_code'); ?></th>
			<th><?php echo $this->Paginator->sort('lab_name'); ?></th>
			<th><?php echo $this->Paginator->sort('river'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('country'); ?></th>
			<th><?php echo $this->Paginator->sort('collector_name'); ?></th>
			<th><?php echo $this->Paginator->sort('researcher_name'); ?></th>
			<th><?php echo $this->Paginator->sort('latitude'); ?></th>
			<th><?php echo $this->Paginator->sort('longitude'); ?></th>
			<th><?php echo $this->Paginator->sort('species_name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($bugs as $bug): ?>
	<tr>
		<td><?php echo h($bug['Bug']['bug_id']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['timestamp']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['bug_photo']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['bug_size']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['specimen_code']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['lab_name']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['river']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['state']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['country']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['collector_name']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['researcher_name']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['latitude']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['longitude']); ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['species_name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $bug['Bug']['bug_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bug['Bug']['bug_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bug['Bug']['bug_id']), null, __('Are you sure you want to delete # %s?', $bug['Bug']['bug_id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Bug'), array('action' => 'add')); ?></li>
	</ul>
</div>
