<?php 
    $action = $this->params['action']; 
    $logged_in_user = $this->Session->read('Auth.User');
?>
<div class="actions">
        <h3><?php echo __('Navigation'); ?></h3>
            <ul>
                    <?php
                        if($action != 'mybugs'){
                            echo '<li>';
                            echo $this->Html->link(__('My Bugs'), array('controller' => 'bugs', 'action' => 'mybugs')); 
                            echo '</li>';
                        }
                        if($action != 'index'){
                            echo '<li>';
                                echo $this->Html->link(__('All Bugs'), array('controller' => 'bugs', 'action' => 'index')); 
                            echo '</li>';
                        }
                        ?>
            </ul>
            <h3><?php echo __('Actions'); ?></h3>
            <ul>
                    <?php
                        if($action != 'edit'){
                            echo '<li>';
                                echo $this->Html->link(__('Edit My Profile'), array('controller' => 'users', 'action' => 'edit', $logged_in_user['id'])); 
                            echo '</li>';
                        }
                        ?>
            </ul>    
</div>
