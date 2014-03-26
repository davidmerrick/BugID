<?php
        // Usage: pass in the $showUploadedBy boolean when you call this to specify whether to show the "Uploaded By" text.
        // In the case of the user viewing his or her own bugs, we don't want this to display

        //AJAX pagination
        $this->Paginator->options(array('update' => '#main-content', 
            'evalScripts' => true,
            //activeTab variable is set in the header of the template
            'complete' => $this->Js->get('#tabs')->each('$(this).tabs({active: activeTab})')
        ));

        $user = $this->Session->read('Auth.User');
        if(!isset($showUploadedBy)){
            $showUploadedBy = true;   
        }

        //Tabs (for details view and thumbnail view)
        echo '<div id="tabs">';
            echo '<ul>';
                echo '<li><a href="#tabs-1">Thumbnail View</a></li>';
                echo '<li><a href="#tabs-2">Details View</a></li>';
            echo '</ul>';
            echo '<div id="tabs-1">';
                foreach ($bugs as $bug){
                    echo '<div class="bug_thumbnail_box">';
                        echo '<div class="image_wrapper">';
                            echo $this->Html->image($bug['Bug']['bug_photo_thumbnail'], array('url' => array('action' => 'view', $bug['Bug']['bug_id'])));
                        echo '</div>';
                        if(isset($bug['Bug']['species_name'])){
                            echo '<br />';
                            echo h($bug['Bug']['species_name']);
                            echo '<br />';
                        }
                        if($showUploadedBy){
                            echo 'Uploaded by: ' . $this->Html->link(($bug['User']['username']), array('controller' => 'app_users', 'action' => 'view', $bug['Bug']['user_id']));
                            echo '<br />';
                            echo 'On ' . h($this->Time->nice($bug['Bug']['created']));
                        } else {
                            echo 'Uploaded on ' . h($this->Time->nice($bug['Bug']['created']));
                        }
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
                        if($showUploadedBy){
                            echo '<th>';
                                echo $this->Paginator->sort('user_id', 'Uploaded by');
                            echo '</th>';
                        }
                        echo '<th class="actions">' . __('Actions') . '</th>';
                    echo '</tr>';
                    foreach($bugs as $bug){
                        echo '<tr>';
                            echo '<td>';
                                echo $this->Html->image($bug['Bug']['bug_photo_thumbnail'], array('class' => 'bug_details_thumbnail', 'url' => array('action' => 'view', $bug['Bug']['bug_id'])));
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
                            if($showUploadedBy){
                                echo '<td>';
                                    echo $this->Html->link(($bug['User']['username']), array('controller' => 'app_users', 'action' => 'view', $bug['Bug']['user_id']));
                                echo '</td>';
                            }
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
        echo $this->Js->writeBuffer(); // Write cached scripts. (For AJAX pagination)
?>