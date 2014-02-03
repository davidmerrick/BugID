<div class="publications view">
<h2><?php echo __('Publication'); ?></h2>
	<dl>
		<dt><?php echo __('Publication Id'); ?></dt>
		<dd>
			<?php echo h($publication['Publication']['publication_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publication Name'); ?></dt>
		<dd>
			<?php echo h($publication['Publication']['publication_name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Publication'), array('action' => 'edit', $publication['Publication']['publication_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Publication'), array('action' => 'delete', $publication['Publication']['publication_id']), null, __('Are you sure you want to delete # %s?', $publication['Publication']['publication_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Publications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Publication'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Publication Issues'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Issues'); ?></h3>
	<?php if (!empty($publication['PublicationIssues'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Issue Id'); ?></th>
		<th><?php echo __('Issue Publication Id'); ?></th>
		<th><?php echo __('Issue Number'); ?></th>
		<th><?php echo __('Issue Date Publication'); ?></th>
		<th><?php echo __('Issue Cover'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($publication['PublicationIssues'] as $publicationIssues): ?>
		<tr>
			<td><?php echo $publicationIssues['issue_id']; ?></td>
			<td><?php echo $publicationIssues['issue_publication_id']; ?></td>
			<td><?php echo $publicationIssues['issue_number']; ?></td>
			<td><?php echo $publicationIssues['issue_date_publication']; ?></td>
			<td><?php echo $publicationIssues['issue_cover']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'issues', 'action' => 'view', $publicationIssues['issue_id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'issues', 'action' => 'edit', $publicationIssues['issue_id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'issues', 'action' => 'delete', $publicationIssues['issue_id']), null, __('Are you sure you want to delete # %s?', $publicationIssues['issue_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Publication Issues'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
