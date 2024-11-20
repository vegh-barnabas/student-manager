<?php
    function is_empty($input, $key) {
        return !(isset($input[$key]) && trim($input[$key]) !== '');
    }

    function contains_letter_and_number($str) {
        $hasLetter = preg_match('/[a-zA-Z]/', $str); // Check for at least one letter
        $hasNumber = preg_match('/[0-9]/', $str);    // Check for at least one number
    
        return $hasLetter && $hasNumber; // Both conditions must be true
    }

    // Calculate age from DOB
    function calculate_age_from_DOB($DOB) {
        $birth_timestamp = strtotime($DOB); // number of seconds since Jan 1 1970
        
        $current_year = date("Y");
        $birth_year = date("Y", $birth_timestamp);
        $age = $current_year - $birth_year;

        // in case of for example:
        // 2024 Nov 14 is the current date
        // 2000 Dec 6 is the birth date
        if(date('md') < date('md', $birth_timestamp)) {
            $age -= 1;
        }

        return $age;
    }
?>