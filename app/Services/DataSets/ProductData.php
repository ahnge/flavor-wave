<?php

namespace App\Services\DataSets;

class ProductData
{
    public static function get()
    {
        return  [
            [
                'title' => "Burmese Bliss",
                'price' => 430000,
                "product_photo"  =>  "https://i2.wp.com/s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-".rand(1,40).".png?ssl=1",
                "pc_per_box"  =>  15,
                "total_box_count" =>  220,
                "available_box_count" =>  170,
                "reserving_box_count" => 30,
            ],
            [
                'title' => "Golden Sunshine Tea",
                'price' => 150000,
                "product_photo"  =>  "https://i2.wp.com/s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-".rand(1,40).".png?ssl=1",
                "pc_per_box"  =>  20,
                "total_box_count" =>  180,
                "available_box_count" =>  150,
                "reserving_box_count" => 14,
            ],
            [
                'title' => "Mango Tango Delight",
                'price' => 230000,
                "product_photo"  =>  "https://i2.wp.com/s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-".rand(1,40).".png?ssl=1",
                "pc_per_box"  =>  25,
                "total_box_count" =>  400,
                "available_box_count" =>  350,
                "reserving_box_count" => 15,
            ],
            [
                'title' => "Rangoon Rosewater Elixir",
                'price' => 60000,
                "product_photo"  =>  "https://i2.wp.com/s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-".rand(1,40).".png?ssl=1",
                "pc_per_box"  =>  18,
                "total_box_count" =>  603,
                "available_box_count" =>  354,
                "reserving_box_count" => 22,
            ],
            [
                'title' => "Golden Sunshine Tea",
                'price' => 150000,
                "product_photo"  =>  "https://i2.wp.com/s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-".rand(1,40).".png?ssl=1",
                "pc_per_box"  =>  22,
                "total_box_count" =>  424,
                "available_box_count" =>  33,
                "reserving_box_count" => 10,
            ],
            [
                'title' => "Coconut Cream Dmrea",
                'price' => 56000,
                "product_photo"  =>  "https://i2.wp.com/s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-".rand(1,40).".png?ssl=1",
                "pc_per_box"  =>  28,
                "total_box_count" =>  339,
                "available_box_count" =>  154,
                "reserving_box_count" => 40,
            ],
            [
                'title' => "Citrus Fusion Fizz",
                'price' => 78500,
                "product_photo"  =>  "https://i2.wp.com/s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-".rand(1,40).".png?ssl=1",
                "pc_per_box"  =>  12,
                "total_box_count" =>  302,
                "available_box_count" =>  60,
                "reserving_box_count" => 33,
            ],


        ];
    }
}
