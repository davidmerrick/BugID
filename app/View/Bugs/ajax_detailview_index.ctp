<?php
        $user = $this->Session->read('Auth.User');
        
        $this->Paginator->options(array('url' => array('action' => 'ajax_detailview_index'), 'update' => '#tabs-2', 'evalScripts' => true));
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
                            echo $this->Paginator->sort('user_id', 'Uploaded by');
                        echo '</th>';
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
                            echo '<td>';
                                echo $this->Html->link(($bug['User']['username']), array('controller' => 'app_users', 'action' => 'view', $bug['Bug']['user_id']));
                            echo '</td>';
                            echo '<td>';
                                echo $this->Element('Bugs/action_index', array('bug' => $bug, 'user' => $user));
                            echo '</td>';
                        echo '</tr>';
                    }
                echo '</table>';
?>