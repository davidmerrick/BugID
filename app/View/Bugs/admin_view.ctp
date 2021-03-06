<div class="bugs view">
<h2><?php echo __('Bug'); ?></h2>
	<dl>
		<dt><?php echo __('Bug Id'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['bug_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timestamp'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['timestamp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bug Photo'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['bug_photo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bug Size'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['bug_size']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Specimen Code'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['specimen_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lab Name'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['lab_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('River'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['river']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Collector Name'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['collector_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Researcher Name'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['researcher_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Longitude'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['longitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Species Name'); ?></dt>
		<dd>
			<?php echo h($bug['Bug']['species_name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bug'), array('action' => 'edit', $bug['Bug']['bug_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Bug'), array('action' => 'delete', $bug['Bug']['bug_id']), null, __('Are you sure you want to delete # %s?', $bug['Bug']['bug_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bugs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug'), array('action' => 'add')); ?> </li>
	</ul>
</div>
