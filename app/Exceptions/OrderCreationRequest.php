<?php

namespace App\Exceptions;

/**
 * App\Exceptions\OrderCreationRequest
 *
 * @Class OrderCreationRequest Ошибка запроса на создание заказа.
 * @package App\Exceptions
 */
class OrderCreationRequest extends JsonRequestVerification
{

    /**
     * Конструктор класса.
     *
     * @param    array    $errors   Ошибки проверки значений полей запроса.
     */
    public function __construct(array $errors)
    {
        parent::__construct($errors);

        $this->keyMessage = __('catalog.error_order_creation_request');
    }

}
