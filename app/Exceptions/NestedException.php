<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use ReflectionClass;

trait NestedException
{
    protected function getRootException()
    {
        return $this->getPrevious();
    }

    public function getErrorData()
    {
        $ex = $this->getRootException();
        if (!is_null($ex)) {
            if ($ex instanceof QueryException) {
                return [
                    "subcode" => (new ReflectionClass($ex))->getShortName(),
                ];
            }
        }
        return parent::getErrorData();
    }
}
