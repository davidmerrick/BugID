<div class="bugs form">
<?php echo $this->Form->create('Bug', array('type' => 'file')); ?>
            <fieldset>
		<legend><?php echo __('Edit Bug'); ?></legend>
	
           <?php
                //Don't allow them to upload a new image or change the classification
                echo $this->Html->image($this->data['Bug']['bug_photo']);
                if(!empty($this->data['Bug']['species_name'])){
                    echo "<h2>Classification: " . $this->data['Bug']['species_name'] . "</h2>";
                } else {
                    echo $this->Form->input('species_name');
                }
                //Disable updates on bug_id and bug_photo
                echo $this->Form->input('bug_id', array('type'=>'hidden'));
                
                //Do let them change everything else
                echo $this->Form->input('bug_size');
		echo $this->Form->input('specimen_code');
		echo $this->Form->input('lab_name');
		echo $this->Form->input('river');
		echo $this->element('statedropdown');
		echo $this->Form->input('country');
		echo $this->Form->input('collector_name');
		echo $this->Form->input('researcher_name');
		echo $this->Form->input('latitude');
		echo $this->Form->input('longitude');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php
echo $this->Element('sidebar');
?>