<?php

namespace Core;

class Validator
{
    public static function required($value): bool
    {
        return strlen(trim($value)) == 0;
    }

    public static function max($value, $max): bool
    {
        return strlen(trim($value)) > $max;
    }

    public static function min($value, $min): bool
    {
        return strlen(trim($value)) < $min;
    }

    public static function email($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function unique($table, $column, $value): bool
    {
        $db     = App::retrieve(Database::class);
        $result = $db->query("SELECT * FROM $table WHERE $column = :value", [
            "value" => $value
        ])->first();

        return !$result;
    }
}
