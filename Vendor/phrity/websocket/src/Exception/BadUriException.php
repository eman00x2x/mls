<?php

/**
 * Copyright (C) 2014-2023 Textalk and contributors.
 *
 * This file is part of Websocket PHP and is free software under the ISC License.
 * License text: https://raw.githubusercontent.com/sirn-se/websocket-php/master/COPYING.md
 */

namespace WebSocket\Exception;

/**
 * WebSocket\Exception\BadUriException class.
 * Thrown when invalid URI is provided.
 */
class BadUriException extends Exception
{
    public function __construct(string $message = '')
    {
        parent::__construct($message ?: 'Bad URI');
    }
}
