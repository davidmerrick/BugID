<?php
$action = $this->params['action']; 
if($action != 'login'){
    echo '<ul id="top-nav">';
        echo '<li>';
            echo $this->Html->link(__('Home'), '/'); 
        echo '</li>';
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
    echo '</ul>';
}