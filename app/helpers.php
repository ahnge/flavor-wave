<?php

use App\Constants\OrderStatusEnum;

if(!function_exists('getRegions')){
    function getRegions(){
        return \App\Models\Region::all();
    }
}

if(!function_exists('getStatusBadge'))
{
    function getStatusBadge(int $status)
    {
        $message = OrderStatusEnum::getLabelForDistributors($status);
        $class  =  OrderStatusEnum::getBadgeClass($status);
        $badge = "<span class='$class'>$message</span>";

        return html_entity_decode($badge);
    }
}
