<div class="bugs view">
<h2><?php echo __('Bug'); ?></h2>
	<dl>
		<dt><?php echo __('Bug Photo'); ?></dt>
		<dd>
                    <?php 
			if($bug['Bug']['bug_photo']){
				echo $this->Html->image($bug['Bug']['bug_photo']);
			} 
			?>
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
			<?php echo h(strtoupper($bug['Bug']['state'])); ?>
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
<?php
echo $this->Element('sidebar');
?>