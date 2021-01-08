<?php
class Region
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
            'region_name' => 'Region Name',
        ];

        return $ordering;
    }
}
?>
