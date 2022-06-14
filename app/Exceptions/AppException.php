<?php

namespace App\Exceptions;

use Exception;
use Reflection;
use ReflectionClass;

abstract class AppException extends Exception
{
    /**
     * @return string
     */
    public function getErrorCode() {
        return (new ReflectionClass(get_class($this)))->getShortName();
    }

    /**
     * @return string
     */
    public function getErrorMessage() {
        return $this->getMessage();
    }

    /**
     * @return array
     */
    public function getErrorData() {
        return [];
    }
}
