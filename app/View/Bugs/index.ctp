<?php 
    //AJAX pagination
    $this->Paginator->options(array('update' => '#main-content', 
                                    'evalScripts' => true,
                                    //Preserve the active tab for after the callback
                                    'before' => $this->Js->set('activeTab', $this->Js->get('#tabs.tabs("option", "active").attr("id")')),
                                    //Just set the tab to 1; the only sorting option is in the detail view anyway
                                    'complete' => $this->Js->get('#tabs')->each('$(this).tabs({active: 1})')));

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