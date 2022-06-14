<?php

namespace App\Exceptions;

class DatabaseIntegrityConstraintViolationException extends AppException implements DatabaseException
{
    public static function build(DatabaseQueryException $ex)
    {
        $code = null;
        $message = null;
        if (preg_match_all('/^Integrity constraint violation: ([0-9]+) (.*?)$/', $ex->resultMessage, $matches)) {
            list(, list($code), list($message)) = $matches;
        }
        $ex = new static($ex, $code, $message);
        switch ($code) {
            case '1451':
                return DatabaseForeignKeyConstraintFailedException::build($ex);
            case '1062':
                return DatabaseUniqueException::build($ex);
        }
        return $ex;
    }

    public function __construct($parent, $subcode, $resultMessage = null)
    {
        $this->parent = $parent;
        $this->subcode = $subcode;
        $this->resultMessage = $resultMessage;
        parent::__construct();
    }

    public function getErrorMessage()
    {
        return sprintf('Query failed by integrity constraint violation: %s - %s', $this->subcode, $this->resultMessage);
    }

    public function getErrorData()
    {
        return [
            "subcode" => $this->subcode,
            "message" => $this->resultMessage,
        ];
    }
}
