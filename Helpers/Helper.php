<?php
class Helper
{
    /**
     * find specific object in object array
     * returns false if it couldn't find anything
     *
     * @param [type] $array
     * @param [type] $searchKey
     * @param [type] $searchValue
     * @return object
     */
    public static function find($array, $searchKey, $searchValue)
    {
        foreach ($array as $sub) {
            if ($sub->$searchKey === $searchValue) {
                return $sub;
            }
        }
        return false;
    }
}