<?php
class Advertising
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
            'name_adver' => 'Advertising Name',
            'ad_content' => 'Advertising Content',
            'img_adver' => 'Advertising Img'

        ];

        return $ordering;
    }
}
?>
