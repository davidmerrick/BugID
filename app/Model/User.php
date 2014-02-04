<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
// app/Model/User.php
class User extends AppModel {
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            ),
            'email' => array(
                'rule'=> array('custom', '/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]+/'),
                'message' => 'Please specify a valid e-mail address'
            )
            
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please enter a password.'
            ),
            'length' => array(
                'rule'    => array('between', 5, 15),
                'message' => 'Passwords must be between 5 and 15 characters long.'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}