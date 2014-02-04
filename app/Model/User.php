<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
// app/Model/User.php
class User extends AppModel {
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please enter an e-mail address.'
            ),
            'isValidEmail' => array(
                'rule'=> 'email',
                'message' => 'Please specify a valid e-mail address.'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This e-mail address has already been registered.'
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
        'repass' => array(
            'equaltofield' => array(
                'rule' => array('equaltofield', 'password'),
                'message' => 'Passwords must match.',
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'nickname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please enter a username.'
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
    
    //Check if the password confirm is equal to the password
    public function equaltofield($check, $otherfield){
        //get name of field
        $fname = '';
        foreach ($check as $key => $value){
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    } 
}