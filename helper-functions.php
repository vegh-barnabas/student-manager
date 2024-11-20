<?php
    // Calculate age from DOB
    function calculate_age_from_DOB(string $DOB): int {
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