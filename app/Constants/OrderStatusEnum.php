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
    case Returned = 6;

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
            case self::Returned->value:
                return 'Returned';
            case self::Delivered->value:
                return 'Delivered';
            case self::Returned->value:
                return 'Returned';
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
                return 'Approved';
            case self::Rejected->value:
                return 'Rejected';
            case self::Assigned->value:
                return 'Shipping';
            case self::Shipped->value:
                return 'Shipped';
            case self::Returned->value:
                return 'Returned';
            case self::Delivered->value:
                return 'Delivered';
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
            ],
            [
                'value' => self::Returned->value,
                'label' => "Returned"
            ]
        ];
    }

    public static function  getBadgeClass(int $value): string
    {
        switch ($value) {
            case self::Pending->value:
                return 'bg-gray-100 text-gray-800 text-xs font-medium  px-2.5 py-1 rounded dark:bg-gray-900 dark:text-gray-300';
            case self::Approved->value:
                return 'bg-green-100 text-green-800 text-xs font-medium  px-2.5 py-1 rounded dark:bg-blue-900 dark:text-blue-300';
            case self::Rejected->value:
                return 'bg-red-100 text-red-800 text-xs font-medium  px-2.5 py-1 rounded dark:bg-red-900 dark:text-red-300';
            case self::Assigned->value:
                return 'bg-green-100 text-green-800 text-xs font-medium  px-2.5 py-1 rounded dark:bg-green-900 dark:text-green-300';
            case self::Shipped->value:
                return 'bg-yellow-100 text-yellow-800 text-xs font-medium  px-2.5 py-1 rounded dark:bg-yellow-900 dark:text-yellow-300';
            case self::Delivered->value:
                return 'bg-green-100 text-green-800 text-xs font-medium  px-2.5 py-1 rounded dark:bg-green-900 dark:text-green-300';
            default:
                return 'bg-gray-100 text-gray-800 text-xs font-medium  px-2.5 py-1 rounded dark:bg-gray-700 dark:text-gray-300';
        }
    }
}
