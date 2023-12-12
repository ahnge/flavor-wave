<?php

namespace App\Constants;

enum OrderStatusEnum: int
{
    case Pending = 0;
    case Approved = 1;
    case Rejected = 2;
    case Assigned = 3;
    case Shipped = 4;
    case Delivered = 5;

    public static function getLabelForAdmins(int $value): string
    {
        switch ($value) {
            case self::Pending->value:
                return 'Pending';
            case self::Approved->value:
                return 'Approved';
            case self::Rejected->value:
                return 'Rejected';
            case self::Assigned->value:
                return 'Assigned';
            case self::Shipped->value:
                return 'Shipped';
            case self::Delivered->value:
                return 'Delivered';
            default:
                return 'Unknown';
        }
    }


    public static function getLabelForDistributors(int $value): string
    {
        switch ($value) {
            case self::Pending->value:
                return 'Pending';
            case self::Approved->value:
                return 'Shipping';
            case self::Rejected->value:
                return 'Rejected';
            case self::Assigned->value:
                return 'Shipping';
            case self::Shipped->value:
                return 'Shipped';
            case self::Delivered->value:
                return 'Delivered';
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
                'value' => self::Assigned->value,
                'label' => "Assigned"
            ],
            [
                'value' => self::Shipped->value,
                'label' => "Shipped"
            ],
            [
                'value' => self::Delivered->value,
                'label' => "Delivered"
            ]
        ];
    }
}
