<?php

namespace App\Exceptions;

class DatabaseUniqueException extends AppException implements DatabaseException
{
    public static function build(DatabaseIntegrityConstraintViolationException $ex)
    {
        $table = null;
        $attribute = null;
        $value = null;
        if (preg_match_all('/^Duplicate entry \'(.*?)\' for key \'(.*?)_(.*)_unique\'$/', $ex->resultMessage, $matches)) {
            list(, list($value), list($table), list($attribute)) = $matches;
        }
        return new static($ex, $table, $attribute, $value);
    }

    public function __construct($parent, $table, $attribute, $value = null)
    {
        $this->parent = $parent;
        $this->table = $table;
        $this->attribute = $attribute;
        $this->value = $value;
        parent::__construct();
    }

    public function getErrorMessage()
    {
        return sprintf('The value "%s" of the attribute "%s.%s" already exists', $this->value, $this->table, $this->attribute);
    }

    public function getErrorData()
    {
        return [
            "table" => $this->table,
            "attribute" => $this->attribute,
            "value" => $this->value,
        ];
    }
}
