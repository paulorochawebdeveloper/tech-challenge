<?php


namespace App\Traits;


trait SortTrait
{

    static function sort($query, $sorts)
    {

        if ($sorts) {
            foreach (explode(",", $sorts) as $sort) {
                list($collum, $direction) = explode(".", $sort);
                $query->orderBy($collum, $direction);
            }
        }

        return $query;

    }

}
