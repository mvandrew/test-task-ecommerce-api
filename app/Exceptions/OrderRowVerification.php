<?php

namespace App\Exceptions;

/**
 * App\Exceptions\OrderRowVerification
 *
 * @Class OrderRowVerification Ошибка проверки структуры данных строки запроса на создание заказа.
 * @package App\Exceptions
 */
class OrderRowVerification extends JsonRequestVerification
{
    public function __construct(array $errors)
    {
        parent::__construct($errors);

        $this->keyMessage = __('catalog.error_order_row_verification');
    }
}
