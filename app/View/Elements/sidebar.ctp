<?php 
$action = $this->params['action']; 
$is_logged_in = $this->Session->read('Auth.User.id');
$user = $this->Session->read('Auth.User');
?>
<div class="actions">
        <h3><?php echo __('Search Bugs'); ?></h3>
        <?php
            echo $this->Form->create('Bug', array(
            'url' => array_merge(array('controller'=>'bugs', 'action' => 'find'), $this->params['pass'])
        ));
        echo $this->Form->input('filter', array('label' => '', 'div' => 'false'));
        echo $this->Form->submit(__('Search'));
        ?>
        
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
                    if(isset($bug) && $bug['User']['username'] == $user['username']){
                        if($action == 'view'){
                            echo '<li>';
                                echo $this->Html->link(__('Edit Bug'), array('action' => 'edit', $bug['Bug']['bug_id']));
                            echo '</li>';
                        }
                        if($action == 'edit' || $action == 'view'){
                            echo '<li>';    
                            echo $this->Form->submit(__('Delete Bug'), array('action' => 'delete', $this->Form->value('Bug.bug_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Bug.bug_id')));
                            echo '</li>';                            
                        }
                    }
                ?>
	</ul>
</div>
