<?php $action = $this->params['action']; ?>
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
                </li>
            </ul>    
</div>
