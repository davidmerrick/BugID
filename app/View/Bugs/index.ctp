<?php 
    $user = $this->Session->read('Auth.User');
    echo '<div class="bugs index">';
        echo '<h2>' . __('All Bugs') . '</h2>';
        
        //Tabs (for list view and thumbnail view)
        echo '<div id="tabs">';
            echo '<ul>';
                echo '<li><a href="#tabs-1">Thumbnail View</a></li>';
                echo '<li><a href="#tabs-2">Details View</a></li>';
            echo '</ul>';
            echo '<div id="tabs-1">';
                foreach ($bugs as $bug){
                    echo '<div class="bug_thumbnail">';
                        if($bug['Bug']['bug_photo_thumbnail']){
                            //Todo: turn this into a link
                            echo $this->Html->image($bug['Bug']['bug_photo_thumbnail']);
                        }
                        echo '<br />';
                        echo h($bug['Bug']['species_name']);
                        echo '<br />';
                        echo 'Uploaded by: ' . $this->Html->link(($bug['User']['username']), array('controller' => 'app_users', 'action' => 'view', $bug['Bug']['user_id']));
                        echo '<br />';
                        echo 'On ' . h($this->Time->nice($bug['Bug']['created']));
                    echo '</div>';
                }
                //for styling; bug thumbnails are floated left so this prevents other content creeping up
                echo '<div id="bug_thumbnails_footer"></div>';
            echo '</div>';
            echo '<div id="tabs-2">';
                //Table stuff
                echo '<table cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                        echo '<th>';
                            echo 'Thumbnail';
                        echo '</th>';
                        echo '<th>';
                            echo $this->Paginator->sort('species_name');
                        echo '</th>';
                        echo '<th>';
                            echo $this->Paginator->sort('specimen_code');
                        echo '</th>';
                        echo '<th>';
                            echo $this->Paginator->sort('created', 'Date Uploaded');
                        echo '</th>';
                        echo '<th>';
                            echo $this->Paginator->sort('user_id', 'User');
                        echo '</th>';
                        echo '<th class="actions">' . __('Actions') . '</th>';
                    echo '</tr>';
                    foreach($bugs as $bug){
                        echo '<tr>';
                            echo '<td>';
                                echo $this->Html->image($bug['Bug']['bug_photo_thumbnail'], array('class' => 'bug_details_thumbnail'));
                            echo '</td>';
                            echo '<td>';
                                echo h($bug['Bug']['species_name']);
                            echo '</td>';
                            echo '<td>';
                                echo h($bug['Bug']['specimen_code']);
                            echo '</td>';
                            echo '<td>';
                                echo h($this->Time->nice($bug['Bug']['created']));
                            echo '</td>';
                            echo '<td>';
                                echo $this->Html->link(($bug['User']['username']), array('controller' => 'app_users', 'action' => 'view', $bug['Bug']['user_id']));
                            echo '</td>';
                            echo '<td>';
                                echo $this->Element('Bugs/action_index', array('bug' => $bug, 'user' => $user));
                            echo '</td>';
                        echo '</tr>';
                    }
                echo '</table>';
            echo '</div>';
        echo '</div>';


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