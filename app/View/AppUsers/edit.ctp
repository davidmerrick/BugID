<?php 
    echo '<div class="users form">';
        echo '<h3>' . __('Edit Profile') . '</h3>';
        if($this->data[$model]['profile_photo']){
            echo $this->Html->image($this->data[$model]['profile_photo'], array('class' => 'profile_photo'));
            echo '<br />';
            //echo $this->Form->postLink(__('Delete Bug'), array('action' => 'delete', '5', null, __('Are you sure you want to delete this bug?')));
            echo $this->Form->postLink(__('Delete Profile Photo'), array('action' => 'delete_profile_photo', $this->data[$model]['id']), null, __('Are you sure you want to delete your profile photo?'));
            echo '<br />';
        }

        echo $this->Form->create($model, array('type' => 'file'));
            echo '<fieldset>';
            //@todo: change this logic. Postlink was causing a problem
            //so I put it above, outside the form
            if(!$this->data[$model]['profile_photo']) {
                 echo $this->Form->input('profile_photo', array('type' => 'file', 'label' => 'Upload Profile Photo'));
            } else {
                echo $this->Form->input('profile_photo', array('type' => 'file', 'label' => 'Change Profile Photo'));
            }
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('university', array('label' => 'University Affiliation'));
            echo '<p>';
                echo $this->Html->link(__('Change your password'), array('action' => 'change_password'));
            echo '</p>';
            echo '</fieldset>';
	echo $this->Form->end(__('Update'));
echo '</div>';
echo $this->element('Users/sidebar'); 
?>