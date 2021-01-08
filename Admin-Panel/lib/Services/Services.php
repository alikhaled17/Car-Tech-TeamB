<?php
class Services
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
            'ser_name' => 'Services Name'
        ];

        return $ordering;
    }
}
?>
