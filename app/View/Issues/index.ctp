<div class="issues index">
	<?php echo $this->Html->tag('h2', __('Issues')); ?>
	<table cellpadding="0" cellspacing="0">
		<?php echo $this->Html->tableHeaders(array(
			$this->Paginator->sort('issue_publication_id'),
			$this->Paginator->sort('issue_number'),
			$this->Paginator->sort('issue_date_publication'),
			$this->Paginator->sort('issue_cover'),
			__('Actions'),
		)); 

		//Table Contents

		$rows = array();
		foreach($issues as $issue){
			$row = array();
			
			//Publication name
			$row[] = $this->Html->link($issue['IssuePublication']['id'], array('controller' => 'issue_publications', 'action' => 'view', $issue['IssuePublication']['id']));
			
			//Issue number
			$row[] = h($issue['Issue']['issue_number']);
			
			//Date published
			$row[] = h($issue['Issue']['issue_date_publication']);
			
			//Cover
			$row[] = $issue['Issue']['issue_cover'] ? 'Y' : 'N';
		
			//Actions
			$actions = array();
			$actions[] = $this->Html->link(__('View'), array('action' => 'view', $issue['Issue']['issue_id']));
			$actions[] = $this->Html->link(__('Edit'), array('action' => 'edit', $issue['Issue']['issue_id']));
			$actions[] = $this->Form->postLink(__('Delete'), array('action' => 'delete', $issue['Issue']['issue_id']), null, __('Are you sure you want to delete # %s?', $issue['Issue']['issue_id']));
			$row[] = array(
				implode(' ', $actions), 
				array('class' => 'actions'),
			);
			$rows[] = $row;
		}
		if(!empty($rows)){
			echo $this->Html->tableCells($rows);
		}

		?>
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
		<li><?php echo $this->Html->link(__('New Issue'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Issue Publications'), array('controller' => 'issue_publications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue Publication'), array('controller' => 'issue_publications', 'action' => 'add')); ?> </li>
	</ul>
</div>
