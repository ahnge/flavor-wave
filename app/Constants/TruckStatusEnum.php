<?php

namespace App\Constants;

enum TruckStatusEnum: int
{
    case AtWarehouse = 0;
    case OnTheRoad = 1;


    public static function getLabel(int $value): string
    {
        switch ($value) {
            case self::AtWarehouse->value:
                return 'At warehouse';
            case self::OnTheRoad->value:
                return 'On the road';
            default:
                return 'Unknown';
        }
    }

    public static function getValues(): array
    {
        return [
            [
                'value' => self::AtWarehouse->value,
                'label' => "At warehouse"
            ],
            [
                'value' => self::OnTheRoad->value,
                'label' => "On the road"
            ],
        ];
    }
}
