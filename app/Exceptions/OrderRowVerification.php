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
    /**
     * Конструктор класса.
     *
     * @param    array    $errors   Ошибки проверки значений полей запроса.
     */
    public function __construct(array $errors)
    {
        parent::__construct($errors);

        $this->message = __('catalog.error_order_row_verification');
    }
}
