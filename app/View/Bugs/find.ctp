<div class="bugs index">
	<h2><?php echo __('Find Bugs'); ?></h2>
	<?php
        /*
        echo $this->Form->create('Bug', array(
            'url' => array_merge(array('action' => 'find'), $this->params['pass'])
        ));
        echo $this->Form->input('filter', array('label' => ''));
        echo $this->Form->submit(__('Search'));
         */
        ?>
        
        <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('species_name'); ?></th>
                        <th><?php echo $this->Paginator->sort('specimen_code'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Date Uploaded'); ?></th>
                        <th><?php echo $this->Paginator->sort('user_id', 'User'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($bugs as $bug): ?>
	<tr>
		<td><?php echo h($bug['Bug']['species_name']); ?>&nbsp;</td>
                <td><?php echo h($bug['Bug']['specimen_code']); ?>&nbsp;</td>
		<td><?php echo h($this->Time->nice($bug['Bug']['created'])); ?>&nbsp;</td>
                <td><?php echo $this->Html->link(($bug['User']['username']), array('controller' => 'app_users', 'action' => 'view', $bug['Bug']['user_id'])); ?>&nbsp;</td>
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
<?php 
echo $this->Element('sidebar');
?>