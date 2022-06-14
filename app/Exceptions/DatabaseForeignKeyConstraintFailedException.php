<?php

namespace App\Exceptions;

class DatabaseForeignKeyConstraintFailedException extends AppException implements DatabaseException
{
    public static function build(DatabaseIntegrityConstraintViolationException $ex)
    {
        $constraint = null;
        if (preg_match_all('/^Cannot delete or update a parent row: a foreign key constraint fails \((.*?)\)$/', $ex->resultMessage, $matches)) {
            list(, list($constraint)) = $matches;
        }
        return new static($ex, $constraint);
    }

    public function __construct($parent, $constraint = null)
    {
        $this->parent = $parent;
        $this->constraint = $constraint;
        parent::__construct();
    }

    public function getErrorMessage()
    {
        return 'Query failed by foreign key constraint failed';
    }
}
