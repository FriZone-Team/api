<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;

class DatabaseQueryException extends AppException implements DatabaseException
{
    public static function build(QueryException $ex)
    {
        $sqlState = $ex->getCode();
        $resultMessage = $ex->getMessage();
        $sql = null;
        if (preg_match_all('/^SQLSTATE\[(.*?)\]: (.*?) \(SQL: (.*)\)$/', $resultMessage, $matches)) {
            list(, list($sqlState), list($resultMessage), list($sql)) = $matches;
        }
        $ex = new static($sqlState, $resultMessage, $sql);
        switch ($sqlState) {
            case 23000:
                return DatabaseIntegrityConstraintViolationException::build($ex);
            case 'HY000':
                return DatabaseGeneralException::build($ex);
        }
        return $ex;
    }

    public function __construct($sqlState, $resultMessage, $sql = null)
    {
        $this->sqlState = $sqlState;
        $this->resultMessage = $resultMessage;
        $this->sql = $sql;
        parent::__construct();
    }

    public function getErrorMessage()
    {
        return sprintf('Query failed with error "%s": %s', $this->sqlState, $this->resultMessage);
    }

    public function getErrorData()
    {
        return [
            "state" => $this->sqlState,
            "message" => $this->resultMessage,
        ];
    }
}
