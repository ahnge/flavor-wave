<?php

namespace App\Constants;

enum OrderStatusEnum :int
{
    case Pending = 0;
    case Approved = 1;
    case Rejected = 2;
    case Received = 3;
    case Returned = 4;

    public static function getLabel(int $value): string
    {
        switch ($value) {
            case self::Pending:
                return 'Pending';
            case self::Approved:
                return 'Approved';
            case self::Rejected:
                return 'Rejected';
            case self::Received:
                return 'Received';
            case self::Returned:
                return 'Returned';
            default:
                return 'Unknown';
        }
    }

    public static function getValues(): array
    {
        return [
            [
                'value' => self::Pending,
                'label' => "Pending"
            ],
            [
                'value' => self::Approved,
                'label' => "Approved"
            ],
            [
                'value' => self::Rejected,
                'label' => "Rejected"
            ],
            [
                'value' => self::Received,
                'label' => "Received"
            ],
            [
                'value' => self::Returned,
                'label' => "Returned"
            ]
        ];
    }
}
