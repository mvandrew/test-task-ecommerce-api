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

    /** @var string|null Ключевое сообщение об ошибке для исключения. */
    protected ?string $keyMessage;

    /**
     * Конструктор класса.
     *
     * @param    array    $errors
     */
    public function __construct(array $errors)
    {
        parent::__construct();

        $this->keyMessage = null;

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

        if (!is_null($this->keyMessage)) {
            $messages[] = $this->keyMessage;
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
