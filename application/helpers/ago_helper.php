<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('kapan'))
{
    function kapan($dt,$precision=2)

    {
    $times=array(   365*24*60*60    => "<font color=red>tahun</font>",
                    30*24*60*60     => "<font color=orange>bulan</font>",
                    7*24*60*60      => "minggu",
                    24*60*60        => "hari",
                    60*60           => "jam",
                    60              => "menit",
                    1               => "detik");

    $passed=time()-$dt;

    if($passed<5)
    {
        $output='sesaat yang lalu';
    }
    elseif($passed > 31536000)
    {
         $output='Lebih dari <font color=red>setahun</font> lalu';
    }
    else
    {
        $output=array();
        $exit=0;

        foreach($times as $period=>$name)
        {
            if($exit>=$precision OR ($exit>0 && $period<60)) break;

            $result = floor($passed/$period);
            if($result>0)
            {
                $output[]=$result.' '.$name;
                $passed-=$result*$period;
                $exit++;
            }
            else
                if($exit>0)
                    $exit++;
        }

        $output=implode(', ',$output).' yang lalu';
    }

    return $output;
  }
}

if ( ! function_exists('kapan2'))
{
    function kapan2($dt,$precision=2)

    {
    $times=array(   365*24*60*60    => "tahun",
                    30*24*60*60     => "bulan",
                    7*24*60*60      => "minggu",
                    24*60*60        => "hari",
                    60*60           => "jam",
                    60              => "menit",
                    1               => "detik");

    $passed=time()-$dt;

    if($passed<5)
    {
        $output='sesaat yang lalu';
    }
    elseif($passed > 31536000)
    {
         $output='Lebih dari setahun lalu';
    }
    else
    {
        $output=array();
        $exit=0;

        foreach($times as $period=>$name)
        {
            if($exit>=$precision OR ($exit>0 && $period<60)) break;

            $result = floor($passed/$period);
            if($result>0)
            {
                $output[]=$result.' '.$name;
                $passed-=$result*$period;
                $exit++;
            }
            else
                if($exit>0)
                    $exit++;
        }

        $output=implode(', ',$output).' yang lalu';
    }

    return $output;
  }
}
/* End of file date_helper.php */
/* Location: ./system/helpers/date_helper.php */