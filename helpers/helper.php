<?php
class Helper
{
    public static function find($array, $searchKey, $searchValue)
    {
        foreach ($array as $sub) {
            if ($sub->$searchKey === $searchValue) {
                return $sub;
            }
        }
    }
}
