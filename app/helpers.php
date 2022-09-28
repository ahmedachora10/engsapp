<?php

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;

function changeLocaleInRoute(Route $route)
{
    if($route){
        $parameters = $route->parameters();
        $currentLocaleParameter = $route->parameter('locale');
        $parameters['locale'] = $currentLocaleParameter == 'ar' ? 'en' : 'ar';
        $name = $route->getName();
        return route($name, $parameters);
    }

    $parameters['locale'] = 'ar' ;
    return route('home', $parameters);

}

function activeClassChecker($activelink, $currentAnchorName)
{
    if (isset($activelink)) {
        if ($activelink == $currentAnchorName)
            return 'active';
        else '';
    } else '';
}


function substrwords($text, $maxchar, $end = '...')
{
    if (strlen($text) > $maxchar || $text == '') {
        $words = preg_split('/\s/', $text);
        $output = '';
        $i      = 0;
        while (1) {
            $length = strlen($output) + strlen($words[$i]);
            if ($length > $maxchar) {
                break;
            } else {
                $output .= " " . $words[$i];
                ++$i;
            }
        }
        $output .= $end;
    } else {
        $output = $text;
    }
    return $output;
}

function viewContent($content, $columnName, $location, $array = '')
{
    $content_data = $content->where($columnName, $location)->first();
    $content_data = App::isLocale('ar') ? $content_data->content_ar : $content_data->content_en;
    if ($array) {

        $array = explode(PHP_EOL, $content_data);
        return $array;
    }
    return $content_data;
}

function viewContentArray($content, $columnName, $location)
{
    $content_data = $content->where($columnName, $location)->all();
    return $content_data;
}


function english_date_format($datetime)
{
    $time = strtotime($datetime);
    $time = time() - $time; // to get the time since that moment
    $time = ($time < 1) ? 1 : $time;
    $tokens = array(
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
    }
}


//arabic_date_format(, $service_request->created_at)

function arabic_date_format($datetime)
{

    $timestamp = strtotime(english_date_format($datetime));
    $periods = array(
        "second"  => '<span title="' . $datetime . '" class="text">ثانية</span>',
        "seconds" => '<span title="' . $datetime . '" class="text">ثواني</span>',
        "minute"  => '<span title="' . $datetime . '" class="text">دقيقة</span>',
        "minutes" => '<span title="' . $datetime . '" class="text">دقائق</span>',
        "hour"    => '<span title="' . $datetime . '" class="text">ساعة</span>',
        "hours"   => '<span title="' . $datetime . '" class="text">ساعات</span>',
        "day"     => '<span title="' . $datetime . '" class="text">يوم</span>',
        "days"    => '<span title="' . $datetime . '" class="text">أيام</span>',
        "month"   => '<span title="' . $datetime . '" class="text">شهر</span>',
        "months"  => '<span title="' . $datetime . '" class="text">شهور</span>',
    );

    $difference = (int) abs(time() - $timestamp);

    $plural = array(3, 4, 5, 6, 7, 8, 9, 10);

    $readable_date = '<span title="' . $datetime . '" class="text">منذ </span>';

    if ($difference < 60) // less than a minute
    {
        $readable_date .= '<span title="' . $datetime . '" class="number">' . $difference . ' </span>'  . " ";
        if (in_array($difference, $plural)) {
            $readable_date .= $periods["seconds"];
        } else {
            $readable_date .= $periods["second"];
        }
    } elseif ($difference < (60 * 60)) // less than an hour
    {
        $diff = (int) ($difference / 60);
        $readable_date .= '<span title="' . $datetime . '" class="number">' . $diff . '</span>' . " ";
        if (in_array($diff, $plural)) {
            $readable_date .= $periods["minutes"];
        } else {
            $readable_date .= $periods["minute"];
        }
    } elseif ($difference < (24 * 60 * 60)) // less than a day
    {
        $diff = (int) ($difference / (60 * 60));
        $readable_date .= '<span title="' . $datetime . '" class="number">' . $diff . '</span>' . " ";
        if (in_array($diff, $plural)) {
            $readable_date .= $periods["hours"];
        } else {
            $readable_date .= $periods["hour"];
        }
    } elseif ($difference < (30 * 24 * 60 * 60)) // less than a month
    {
        $diff = (int) ($difference / (24 * 60 * 60));
        $readable_date .= '<span title="' . $datetime . '" class="number">' . $diff . '</span>' . " ";
        if (in_array($diff, $plural)) {
            $readable_date .= $periods["days"];
        } else {
            $readable_date .= $periods["day"];
        }
    } elseif ($difference < (365 * 24 * 60 * 60)) // less than a year
    {
        $diff = (int) ($difference / (30 * 24 * 60 * 60));
        $readable_date .= '<span title="' . $datetime . '" class="number">' . $diff . '</span>' . " ";

        if (in_array($diff, $plural)) {
            $readable_date .= $periods["months"];
        } else {
            $readable_date .= $periods["month"];
        }
    } else {
        // $readable_date = date("d-m-Y", $timestamp);
        $diff = (int) ($difference / (30 * 24 * 60 * 60));
        $readable_date .= '<span title="' . $datetime . '" class="number">' . $diff . '</span>' . " ";

        if (in_array($diff, $plural)) {
            $readable_date .= $periods["months"];
        } else {
            $readable_date .= $periods["month"];
        }
    }

    return $readable_date;
}
