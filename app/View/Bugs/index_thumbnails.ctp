<?php $user = $this->Session->read('Auth.User'); ?>
<div class="bugs thumbnails">
	<h2><?php echo __('All Bugs'); ?></h2>
	<?php 
        foreach ($bugs as $bug){
            echo '<div>';
                echo h($bug['Bug']['species_name']);
                echo h($bug['Bug']['specimen_code']); 
                echo h($this->Time->nice($bug['Bug']['created']));
                echo $this->Html->link(($bug['User']['username']), array('controller' => 'app_users', 'action' => 'view', $bug['Bug']['user_id']));
                echo $this->Element('Bugs/action_index', array('bug' => $bug, 'user' => $user));
	            echo '</div>';
        }
    ?>
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