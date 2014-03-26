<div class="bugs form">
<?php echo $this->Form->create('Bug', array('type' => 'file', 'multiple')); ?>
	<fieldset>
		<legend><?php echo __('Upload Bugs'); ?></legend>
	<?php
        //Disable the security component on this field
        //Todo: find a better way to do this
        $this->Form->unlockField('bug_photo_raw');
        
        //Multiple enables multiple bug photos to be selected
        echo $this->Form->input('bug_photo_raw.', array('type' => 'file', 'multiple', 'label' => 'Select one or more bug images'));
        

        //Set smallest bug size to 0 mm and largest to 800
        echo $this->Form->input('bug_size', array('label' => 'Bug Size (mm)', 'min' => '0', 'max' => '800'));
		echo $this->Form->input('specimen_code');
		echo $this->Form->input('lab_name');
		
        //Collector/researcher data
        echo $this->Form->input('collector_name');
		echo $this->Form->input('researcher_name');
                
        //Location data
        echo $this->Form->input('country');
        echo $this->element('statedropdown');
        echo $this->Form->input('river');
		echo $this->Form->input('latitude');
		echo $this->Form->input('longitude');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>