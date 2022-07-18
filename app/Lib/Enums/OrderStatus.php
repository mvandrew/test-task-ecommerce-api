<?php

namespace App\Lib\Enums;

/**
 * App\Lib\Enums\OrderStatus
 *
 * @Class OrderStatus Статусы заказа.
 * @package App\Lib\Enums
 */
class OrderStatus
{
    /** @var int Открыт. */
    public const OPEN = 0;

    /** @var int В обработке. */
    public const PROCESSING = 1;

    /** @var int Доставлен. */
    public const DELIVERED = 2;

    /** @var int Отменён. */
    public const CANCELED = 3;

    /** @var int Закрыт. */
    public const CLOSED = 4;

    public static function getLabel(int $status): ?string
    {
        return match ($status) {
            self::OPEN          => 'Открыт',
            self::PROCESSING    => 'В обработке',
            self::DELIVERED     => 'Доставлен',
            self::CANCELED      => 'Отменён',
            self::CLOSED        => 'Закрыт',
            default             => null
        };
    }
}
