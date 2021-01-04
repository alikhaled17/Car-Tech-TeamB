<?php
class Users
{

    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function setOrderingValues()
    {
        $ordering = [
            'id' => 'ID',
            'username' => 'User Name',
            'email' => 'Email',
            'gender' => 'Gender',
            'phone' => 'Phone',
            'account_type' => 'account_type'
            
        ];

        return $ordering;
    }
}
?>
