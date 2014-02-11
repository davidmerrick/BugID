<div class="bugs index">
	<h2><?php echo __('Find Users'); ?></h2>
        
        <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
                        <th><?php echo $this->Paginator->sort('email'); ?></th>
                        <th><?php echo $this->Paginator->sort('first_name'); ?></th>
                        <th><?php echo $this->Paginator->sort('last_name'); ?></th>
                        <th><?php echo $this->Paginator->sort('university'); ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo $this->Html->link(($user[$model]['username']), array('controller' => 'app_users', 'action' => 'view', $user[$model]['id'])); ?>&nbsp;</td>
                <td><?php echo h($user[$model]['email']); ?>&nbsp;</td>
                <td><?php echo h($user[$model]['first_name']); ?>&nbsp;</td>
                <td><?php echo h($user[$model]['last_name']); ?>&nbsp;</td>
                <td><?php echo h($user[$model]['university']); ?>&nbsp;</td>
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