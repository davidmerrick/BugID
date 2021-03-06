<?php $user = $this->Session->read('Auth.User'); ?>
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
                        <th><?php echo $this->Paginator->sort('country'); ?></th>
                        <th><?php echo $this->Paginator->sort('state'); ?></th>
                        <th><?php echo $this->Paginator->sort('lab_name'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Date Uploaded'); ?></th>
                        <th><?php echo $this->Paginator->sort('user_id', 'User'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($bugs as $bug): ?>
	<tr>
		<td><?php echo h($bug['Bug']['species_name']); ?>&nbsp;</td>
                <td><?php echo h($bug['Bug']['specimen_code']); ?>&nbsp;</td>
                <td><?php echo h($bug['Bug']['country']); ?>&nbsp;</td>
                <td><?php echo h($bug['Bug']['state']); ?>&nbsp;</td>
                <td><?php echo h($bug['Bug']['lab_name']); ?>&nbsp;</td>
		<td><?php echo h($this->Time->nice($bug['Bug']['created'])); ?>&nbsp;</td>
                <td><?php echo $this->Html->link(($bug['User']['username']), array('controller' => 'app_users', 'action' => 'view', $bug['Bug']['user_id'])); ?>&nbsp;</td>
                <td><?php echo $this->Element('Bugs/action_index', array('bug' => $bug, 'user' => $user));?></td>
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