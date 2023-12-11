<?php

if(!function_exists('getRegions')){
    function getRegions(){
        return \App\Models\Region::all();
    }
}
