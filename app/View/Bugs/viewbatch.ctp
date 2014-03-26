<?php 
echo '<div class="bugs index">';
	echo '<h2>' . __('Last Upload') . '</h2>';
    echo $this->Element('Bugs/tabs_bugs', array('showUploadedBy' => false));
echo '</div>';
