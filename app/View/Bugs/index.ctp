<?php 
    //AJAX pagination
    $this->Paginator->options(array('update' => '#content', 'evalScripts' => true));

    $user = $this->Session->read('Auth.User');
    echo '<div class="bugs index">';
        echo '<h2>' . __('All Bugs') . '</h2>';
        

        echo $this->Element('Bugs/tabs_allbugs');

        echo '<p>';
        echo $this->Paginator->counter(array(
        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        echo '</p>';
        echo '<div class="paging">';
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        echo '</div>';
    echo '</div>';
?>