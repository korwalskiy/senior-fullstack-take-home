<?php

namespace Application\Exception;

class BadQueryException extends ActiveRecordException
{
    public function __construct(string $sqlmessage, string $message)
    {
        error_log(print_r($sqlmessage, true));
        parent::__construct($message);
    }
}
