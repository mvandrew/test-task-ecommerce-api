<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * App\Exceptions\JsonRequestVerification
 *
 * @Class JsonRequestVerification Ошибка верификации значений полей при обработке входящего JSON запроса к API.
 * @package App\Exceptions
 */
abstract class JsonRequestVerification extends Exception
{
    /** @var string[] Сообщения об ошибках верификации. */
    protected array $verificationErrors;

    /**
     * Конструктор класса.
     *
     * @param    array    $errors
     */
    public function __construct(array $errors)
    {
        parent::__construct();

        $this->message = '';

        $this->verificationErrors = [];
        foreach ($errors as $error) {
            if (is_array($error)) {
                foreach ($error as $value) {
                    $this->verificationErrors[] = $value;
                }
            } else {
                $this->verificationErrors[] = $error;
            }
        }
    }

    /**
     * Отображение сообщения об ошибке в структуре данных строки запроса на создание заказа.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        $messages = [];

        if (!empty($this->message)) {
            $messages[] = $this->message;
        }

        foreach ($this->verificationErrors as $verificationError) {
            $messages[] = $verificationError;
        }

        return response()->json(
            [
                'message' => $messages,
            ],
            400
        );
    }
}
