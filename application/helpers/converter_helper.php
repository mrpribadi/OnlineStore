<?php

// convert menit ke jam dan menit
if(!function_exists('minutesToTime')) {
    function minutesToTime($value) {
        $hours = sprintf("%'.02d", round($value / 60));
        // $minutes = $value % 60;
        $minutes = sprintf("%'.02d", ($value % 60));

        return $hours.'.'.$minutes;
    }
}


// convert id jenis absensi
if(!function_exists('jenisTerlambat')) {
    function jenisTerlambat($id_jenis) {
        $CI = get_instance();
        $CI->load->model('appmodel');
        $results = $CI->appmodel->getAllData("SELECT * FROM static_options WHERE name = 'TERLAMBAT'");

        $return = '';
        foreach($results as $result){

            $result->options = json_decode($result->options, true);
            foreach ($result->options as $option) {
                if($option['value'] == $id_jenis){
                    $return = $option['text'];
                }
            }
        }

        return $return;
    }
}

if(!function_exists('convertSeconds')) {
    function convertSeconds($seconds) {
        $return = array();

        $hari = floor($seconds / 86400);
        $sisa1 = $seconds - ($hari*86400);
        if($hari){
            $return[] = $hari.' hari';
        }

        $jam = floor($sisa1 / 3600);
        $sisa2 = $sisa1 - ($jam*3600);
        if($jam){
            $return[] = $jam.' jam';
        }

        $menit = floor($sisa2 / 60);
        $sisa3 = $sisa2 - ($menit*60);
        if($menit){
            $return[] = $menit.' menit';
        }

        if($sisa3){
            $return[] = $sisa3.' detik';
        }

        return implode(', ', $return);


        // $dt1 = new DateTime("@0");
        // $dt2 = new DateTime("@$seconds");
        // return $dt1->diff($dt2)->format('%a hari, %h jam, %i menit, %s detik');
    }
}

