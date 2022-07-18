<?php

namespace App\Exceptions;

use Exception;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

/**
 * App\Exceptions\OrderNotFound
 *
 * @Class OrderNotFound Запрашиваемый заказ не обнаружен в БД.
 * @package App\Exceptions
 */
class OrderNotFound extends Exception
{
    /** @var int ИД запрашиваемого заказа. */
    private int $orderId;

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct();
    }
}
