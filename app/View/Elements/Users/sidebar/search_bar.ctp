<?php
    //Search bar
    echo '<h3>' . __('Search Users') . '</h3>';
    echo $this->Form->create('AppUser', array(
        'url' => array_merge(array('controller'=>'app_users', 'action' => 'find'), $this->params['pass'])
    ));
    echo $this->Form->input('filter', array('label' => '', 'div' => 'false'));
    echo $this->Form->end(__('Search'));

