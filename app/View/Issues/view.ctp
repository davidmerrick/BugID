<div class="issues view">
<h2><?php echo __('Issue'); ?></h2>
	<dl>
		<dt><?php echo __('Issue Id'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['issue_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issue Publication'); ?></dt>
		<dd>
			<?php echo $this->Html->link($issue['IssuePublication']['id'], array('controller' => 'issue_publications', 'action' => 'view', $issue['IssuePublication']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issue Number'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['issue_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issue Date Publication'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['issue_date_publication']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issue Cover'); ?></dt>
		<dd>
			<?php 
			if($issue['Issue']['issue_cover']){
				echo $this->Html->image($issue['Issue']['issue_cover']);
			} 
			?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Issue'), array('action' => 'edit', $issue['Issue']['issue_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Issue'), array('action' => 'delete', $issue['Issue']['issue_id']), null, __('Are you sure you want to delete # %s?', $issue['Issue']['issue_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Issue Publications'), array('controller' => 'issue_publications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue Publication'), array('controller' => 'issue_publications', 'action' => 'add')); ?> </li>
	</ul>
</div>
