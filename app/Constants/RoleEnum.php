<?php

namespace App\Constants;

enum RoleEnum :int
{
    case Admin = 1;
    case Sale = 2;
    case Logistic = 3;
    case Warehouse = 4;
    case Factory = 5;
    case Driver = 6;

    public static function getLabel(int $value): string
    {
        switch ($value) {
            case self::Admin:
                return 'Admin';
            case self::Sale:
                return 'Sale';
            case self::Logistic:
                return 'Logistic';
            case self::Warehouse:
                return 'Warehouse';
            case self::Factory:
                return 'Factory';
            case self::Driver:
                return 'Driver';
            default:
                return 'Unknown';
        }
    }

    public static function getValueByLabel(string $label): int
    {
        switch ($label) {
            case 'Admin':
                return self::Admin->value;
            case 'Sale':
                return self::Sale->value;
            case 'Logistic':
                return self::Logistic->value;
            case 'Warehouse':
                return self::Warehouse->value;
            case 'Factory':
                return self::Factory->value;
            case 'Driver':
                return self::Driver->value;
            default:
                return 0;
        }
    }

    public static function getValues(): array
    {
        return [
            [
                'value' => self::Admin,
                'label' => "Admin"
            ],
            [
                'value' => self::Sale,
                'label' => "Sale"
            ],
            [
                'value' => self::Logistic,
                'label' => "Logistic"
            ],
            [
                'value' => self::Warehouse,
                'label' => "Warehouse"
            ],
            [
                'value' => self::Factory,
                'label' => "Factory"
            ],
            [
                'value' => self::Driver,
                'label' => "Driver"
            ]
        ];
    }
}
