<?php

namespace App\Exceptions;

trait CanNextException
{
    protected function getNextException()
    {
        return null;
    }

    public function getErrorCode()
    {
        $ex = $this->getNextException();
        if (!is_null($ex)) {
            return $ex->getErrorCode();
        }
        return parent::getErrorCode();
    }

    public function getErrorMessage()
    {
        $ex = $this->getNextException();
        if (!is_null($ex)) {
            return $ex->getErrorMessage();
        }
        return parent::getErrorMessage();
    }

    public function getErrorData()
    {
        $ex = $this->getNextException();
        if (!is_null($ex)) {
            return $ex->getErrorData();
        }
        return parent::getErrorData();
    }
}
