<?php
class Admins
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
            'user_name' => 'User Name',
            'admin_type' => 'Admin Type'
        ];

        return $ordering;
    }
}
?>
