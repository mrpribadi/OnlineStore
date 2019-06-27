<?php

if (!function_exists('getDayID')) {
  function getDayID($value)
  {
    $days = array('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu');

    return $days[$value - 1];
  }
}

if (!function_exists('getDayEN')) {
  function getDayEN($value)
  {
    return date('N', $value);
  }
}

if (!function_exists('getMonthID')) {
  function getMonthID($value)
  {
    $months = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

    return $months[$value - 1];
  }
}

if (!function_exists('getMonthEN')) {
  function getMonthEN($value)
  {
    return date('F', $value);
  }
}

if (!function_exists('dateDiff')) {
  function dateDiff($time1, $time2, $precision = 6)
  {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
    $intervals = array('year', 'month', 'day', 'hour', 'minute', 'second');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }

      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }

    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
        break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
        // Add s if value is not 1
        if ($value != 1) {
          // $interval .= "s";
        }

        switch ($interval) {
          case 'year':
            $interval = 'tahun';
            break;
          case 'month':
            $interval = 'bulan';
            break;
          case 'day':
            $interval = 'hari';
            break;
          case 'hour':
            $interval = 'jam';
            break;
          case 'minute':
            $interval = 'menit';
            break;
          case 'second':
            $interval = 'detik';
            break;

          default:
            # code...
            break;
        }
        // Add value and interval to times array
        $times[] = $value . " " . $interval;
        $count++;
      }
    }

    // Return string with times
    return implode(", ", $times);
  }
}

if (!function_exists('formatUang')) {
  function formatUang($value)
  {
    return number_format($value, 2, ".", ",");
  }
}

if (!function_exists('formatTanggal')) {
  function formatTanggal($value)
  {
    return date("d M Y", strtotime($value));
  }
}
