<?php

function urlimage($x){
    return url('/foto') . '/' . $x;
}

function urldoc($x){
    return url('/dokumen') . '/' . $x;
}

function age($x){
    $years = Carbon::parse($x)->age;
    return $years;
}


function dateformat($a){

 
    // Creating timestamp from given date
    $timestamp = strtotime($a);
    
    // Creating new date format from that timestamp
    $new_date = date("d-m-Y", $timestamp);
    return $new_date; // Outputs: 31-03-2019
}


function filefoto($a,$b){
    $extension = $a->getClientOriginalExtension();
    $namefile = $b.'-'.now()->timestamp.'.'.$extension;
    $b->move('foto', $namefile);

    return $namefile;
}
?>