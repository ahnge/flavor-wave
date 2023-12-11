<?php

namespace App\Constants;

enum OrderStatusEnum: int
{
    case Pending = 0;
    case Approved = 1;
    case Rejected = 2;
    case Received = 3;
    case Returned = 4;

    public static function getLabel(int $value): string
    {
        switch ($value) {
            case self::Pending->value:
                return 'Pending';
            case self::Approved->value:
                return 'Approved';
            case self::Rejected->value:
                return 'Rejected';
            case self::Received->value:
                return 'Received';
            case self::Returned->value:
                return 'Returned';
            default:
                return 'Unknown';
        }
    }

    public static function getValues(): array
    {
        return [
            [
                'value' => self::Pending->value,
                'label' => "Pending"
            ],
            [
                'value' => self::Approved->value,
                'label' => "Approved"
            ],
            [
                'value' => self::Rejected->value,
                'label' => "Rejected"
            ],
            [
                'value' => self::Received->value,
                'label' => "Received"
            ],
            [
                'value' => self::Returned->value,
                'label' => "Returned"
            ]
        ];
    }
}
