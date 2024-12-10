<?php
    function is_at_least_18($date_of_birth) {
        // Extract year, month, and day from the date string
        $parts = explode('-', $date_of_birth);
        $year = $parts[0];
        $month = $parts[1];
        $day = $parts[2];
    
        // Get the current year, month, and day
        $current_year = date('Y');
        $current_month = date('m');
        $current_day = date('d');
    
        // Calculate the age
        $age = $current_year - $year;
    
        // Adjust age if the current date is before the birthday this year
        if ($current_month < $month || ($current_month == $month && $current_day < $day)) {
            $age--;
        }
    
        // Return true if the age is 18 or older, false otherwise
        return ($age >= 18);
    }

    function redirect($page) {
        header("Location: $page");
        exit();
    }

    function generate_random_neptun() {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $length = 6;
        $neptun = '';

        for ($i = 0; $i < $length; $i++) {
            $random_index = rand(0, strlen($characters) - 1);
            $neptun = $neptun . $characters[$random_index];
        }

        return $neptun; 
    }

    function contains_only_uppercase_letters_and_numbers($string) {
        if (trim($string) === '') {
            return false;
        }
    
        for ($i = 0; $i < strlen($string); $i++) {
            $char = $string[$i];
            // Check if the character is not an uppercase letter or a digit
            if (!ctype_upper($char) || !ctype_digit($char)) {
                return false;
            }
        }
    
        return true;
    }

    function contains_letter_and_number($string) {
        $has_letter = false;
        $has_number = false;
    
        for ($i = 0; $i < strlen($string); $i++) {
            $char = $string[$i];
    
            // Check if the character is a letter
            if (ctype_alpha($char)) {
                $has_letter = true;
            }
            // Check if the character is a digit
            if (ctype_digit($char)) {
                $has_number = true;
            }
    
            if ($has_letter && $has_number) {
                return true;
            }
        }
    
        return false;
    }

    function is_empty($input, $key) {
        return !(isset($input[$key]) && trim($input[$key]) !== '');
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