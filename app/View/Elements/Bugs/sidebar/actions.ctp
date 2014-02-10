<?php
$action = $this->params['action']; 
$is_logged_in = $this->Session->read('Auth.User.id');
$user = $this->Session->read('Auth.User');
if($action != 'add'){
    echo '<h3>' . __('Actions') . '</h3>';
    echo '<ul>';
            echo '<li>';
                echo $this->Html->link(__('New Bug'), array('action' => 'add')); 
            echo '</li>';
            if(isset($bug) && $bug['User']['username'] == $user['username']){
                if($action == 'view'){
                    echo '<li>';
                        echo $this->Html->link(__('Edit Bug'), array('action' => 'edit', $bug['Bug']['bug_id']));
                    echo '</li>';
                }
                if($action == 'edit' || $action == 'view'){
                    echo '<li>';    
                    echo $this->Form->postLink(__('Delete Bug'), array('action' => 'delete', $bug['Bug']['bug_id']), null, __('Are you sure you want to delete this bug?'));
                    echo '</li>';                            
                }
            }
    echo '</ul>';
}

