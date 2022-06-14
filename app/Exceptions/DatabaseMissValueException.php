<?php

namespace App\Exceptions;

class DatabaseMissValueException extends AppException implements DatabaseException
{
    public static function build(DatabaseGeneralException $ex)
    {
        $attribute = null;
        if (preg_match_all('/^Field \'(.*?)\' doesn\'t have a default value$/', $ex->resultMessage, $matches)) {
            list(, list($attribute)) = $matches;
        }
        return new static($ex, $attribute);
    }

    public function __construct($parent, $attribute)
    {
        $this->parent = $parent;
        $this->attribute = $attribute;
        parent::__construct();
    }

    public function getErrorMessage()
    {
        return sprintf('The attribute "%s" requires a value', $this->attribute);
    }

    public function getErrorData()
    {
        return [
            "attribute" => $this->attribute,
        ];
    }
}
