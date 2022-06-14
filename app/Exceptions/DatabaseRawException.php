<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;

class DatabaseRawException extends AppException implements DatabaseException
{
    use NestedException, CanNextException {
        CanNextException::getErrorData insteadof NestedException;
    }

    protected function getNextException()
    {
        $ex = $this->getRootException();
        if ($ex instanceof QueryException) {
            return DatabaseQueryException::build($ex);
        }
        return null;
    }
}
