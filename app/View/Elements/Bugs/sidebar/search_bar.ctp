<?php
echo '<h3>' . __('Search Bugs') . '</h3>';
echo $this->Form->create('Bug', array(
    'url' => array_merge(array('controller'=>'bugs', 'action' => 'find'), $this->params['pass'])
));
echo $this->Form->input('filter', array('label' => '', 'div' => 'false'));
echo $this->Form->end(__('Search'));
