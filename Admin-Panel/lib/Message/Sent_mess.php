<?php
class Sent_Message
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
            'mess_name' => 'Name',
            'mess_from' => 'Email',
            'mess_to' => 'Subject',
            'mess_subject' => 'Massege',
            'mess_text' => 'Date Time',
            'mess_text' => 'Date Time'
        ];

        return $ordering;
    }
}
?>
