<?php $action = $this->params['action']; ?>
<div class="actions">
        <h3><?php echo __('Navigation'); ?></h3>
            <ul>
                    <?php
                        if($action != 'mybugs'){
                            echo '<li>';
                            echo $this->Html->link(__('My Bugs'), array('action' => 'mybugs')); 
                            echo '</li>';
                        }
                        if($action != 'index'){
                            echo '<li>';
                            echo $this->Html->link(__('All Bugs'), array('action' => 'index')); 
                            echo '</li>';
                        }
                        ?>
                </li>
            </ul>    
        <h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php 
                    if($action != 'add'){
                        echo '<li>';
                        echo $this->Html->link(__('New Bug'), array('action' => 'add')); 
                        echo '</li>';
                    }
                    if($action == 'view'){
                        echo '<li>';
                        echo $this->Html->link(__('Edit Bug'), array('action' => 'edit', $bug['Bug']['bug_id']));
                        echo '</li>';
                    }
                    if($action == 'edit' || $action == 'view'){
                        echo '<li>';
                        echo $this->Form->postLink(__('Delete Bug'), array('action' => 'delete', $this->Form->value('Bug.bug_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Bug.bug_id')));
                        echo '</li>';
                    }
                ?>
	</ul>
</div>
