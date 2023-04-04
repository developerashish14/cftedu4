<?php 
namespace App\Helpers;

class Arithmetic_Helper 
{
    /** 
    * Round percentage to nearest whole number
    * @param float value of percentage
    * @param integer value of precision desired
    * @return string percentage %
    */
    public function round_percentage($percentage, $precision) 
    {
        return round($percentage, $precision) . '%';
    }


    /** 
    * Calculate percentage by adding values together to find
    * total, then dividing by key value. Then calls round
    * percentage
    * @param array of values from table to include in 
    * calculation
    * @param integer of key value in percentage 
    * @return float of calculated percentage to desired precision
    */
       
    public function get_percentage($total, $key_value, $precision) 
    {
        // Can't divide by zero
        if ($total == 0) {
            return round_percentage(0,0);
        }
        else {
            $percentage = ($key_value / $total) * 100;
            $roundPercent = round_percentage($percentage, $precision);
            return $roundPercent;
        }
    }


    /**
     * Determine which time interval is most reasonable
     * @param datetime1 object of date in question
     * @param datetime2 object of date in queston
     * @return string of date elapsed in words
     */
    public function get_date_words($datetime1, $datetime2) 
    {
        $dateIntervals = get_intervals_date($datetime1, $datetime2);
        $dateWords = '';

        if ($dateIntervals['years'] > 0) {
            $dateWords = $dateIntervals['years'] . ' Years';
            if ($dateIntervals['years'] == 1) {
                $dateWords = $dateIntervals['years'] . ' Year';
            }
        }
        elseif ($dateIntervals['months'] > 0){
            $dateWords = $dateIntervals['months'] . ' Months';
            if ($dateIntervals['months'] == 1) {
                $dateWords = $dateIntervals['months'] . ' Month';
            }
        }
        elseif ($dateIntervals['weeks'] > 0){
            $dateWords = $dateIntervals['weeks'] . ' Weeks';
            if ($dateIntervals['weeks'] == 1) {
                $dateWords = $dateIntervals['weeks'] . ' Week';
            }
        }
        elseif ($dateIntervals['days'] > 0){
            $dateWords = $dateIntervals['days'] . ' Days';
            if ($dateIntervals['days'] == 1) {
                $dateWords = $dateIntervals['days'] . ' Day';
            } 
        }
        elseif ($dateIntervals['hours'] > 0){
            $dateWords = $dateIntervals['hours'] . ' Hours';
            if ($dateIntervals['hours'] == 1) {
                $dateWords = $dateIntervals['hours'] . ' Hour';
            }
        }
        elseif ($dateIntervals['mins'] > 0){
            $dateWords = $dateIntervals['mins'] . ' Mins';
            if ($dateIntervals['mins'] == 1) {
                $dateWords = $dateIntervals['mins'] . ' Min';
            }
        }
        elseif ($dateIntervals['secs'] > 0){
            $dateWords = $dateIntervals['secs'] . ' Secs';
            if ($dateIntervals['secs'] == 1) {
                $dateWords = $dateIntervals['secs'] . ' Sec';
            }
        }
        else {
            $dateWords = 'Just Now';
        }

        return $dateWords;
    }

    /**
    * Convert Y/m/d to string date and find today's date
    * Calculate difference between today's date and date passed as * variable.
    * Store each interval in array
    * @param datetime formatted date to find difference between
    * @param datetime formatted date to find differnce between
    * @return array of all time intervals
    */
    public function get_intervals_date($datetime1, $datetime2) 
    {
        $date1 = new DateTime($datetime1);
        $date2 = new DateTime($datetime2);

        $interval = date_diff($date1, $date2);
        
        $years = $interval->format('%y');
        $months = $interval->format('%m');
        $weeks = $interval->format('%W');
        $days = $interval->format('%d');
        $hours = $interval->format('%h');
        $mins = $interval->format('%i');
        $secs = $interval->format('%s');

        $dateIntervals = array(
            'years' => $years,
            'months' => $months,
            'weeks' => $weeks,
            'days' => $days,
            'hours' => $hours,
            'mins' => $mins,
            'secs' => $secs,
        );

        return $dateIntervals;
    }

    /**
    * Convert DATETIME format to Y/m/d format
    * @param DATETIME
    * @return string 'Y/m/d'
    */
    public function get_string_time($datetime) 
    {
        $datetime_str = strtotime($datetime);
        
        $date_str = date('m/d/y', $datetime_str);
        
        return $date_str;
    }

    /**
     * Convert numbers into nearest thousand format to one decimal place
     * (i.e. ---.- k, m, b, t)
     * @param int number to be formatted
     * @return string number formatted in nearest thousand format with trailing decimal place 
     */
    public function get_num_words($num) 
    {
        if ($num > 999) {
                $num_round = round($num);
                $num_separated = number_format($num_round);
                $num_array = explode(',', $num_separated);
                $num_parts = array('k', 'm', 'b', 't');
                $num_count_parts = count($num_array) - 1;

                $num_display = $num_round;
                // First part of thousand separated format (up to 3 digits). If the first digit of the second part of thousand separated format (the decimal in this case) does not equal 0, add decimal place and digit. Otherwise do not display 0 after decimal.
                $num_display = $num_array[0] . ((int) $num_array[1][0] !== 0 ? '.' . $num_array[1][0] : '');
                // Based on number of thousand separations -1 (for array starting at [0]) select k,m,b,t
                $num_display .= $num_parts[$num_count_parts - 1];

                return $num_display;
        } else {
            return $num;
        }
    }
}

?>