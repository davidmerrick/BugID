<?php 

echo '<div class="bugs index">';
    if(isset($bugs[0]['User']['username'])){
        echo '<h2>' . __($bugs[0]['User']['username'] . '\'s Bugs') . '</h2>';
    } else {
        echo '<h2>' . __('User\'s Bugs') . '</h2>';
    }
    echo $this->Element('Bugs/tabs_bugs');
echo '</div>';