<?php
class Message
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
            'Name' => 'Name',
            'Email' => 'Email',
            'Subject' => 'Subject',
            'Massege' => 'Massege',
            'date_time' => 'Date Time'
        ];

        return $ordering;
    }
}
?>
