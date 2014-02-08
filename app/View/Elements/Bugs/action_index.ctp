<?php
echo $this->Html->link(__('View'), array('action' => 'view', $bug['Bug']['bug_id']));
if($bug['User']['username'] == $user['username']){
    echo ' ';
    echo $this->Html->link(__('Edit'), array('action' => 'edit', $bug['Bug']['bug_id']));
    echo ' ';
    echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bug['Bug']['bug_id']), null, __('Are you sure you want to delete # %s?', $bug['Bug']['bug_id']));
}

