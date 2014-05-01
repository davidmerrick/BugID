<?php    
echo '<div class="actions">';
    echo $this->Element('Users/sidebar/search_bar');
    echo $this->Element('Users/sidebar/actions');
    if($this->Session->read('Auth.User.is_admin')){
        echo '<li>&nbsp;</li>';
            echo '<li>' . $this->Html->link(__('List Users'), array('action'=>'index')); 
        echo '</li>';
    }
echo '</div>';
?>