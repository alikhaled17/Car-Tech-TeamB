<?php
class Cities
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
            'city_name' => 'City Name',
        ];

        return $ordering;
    }
}
?>
