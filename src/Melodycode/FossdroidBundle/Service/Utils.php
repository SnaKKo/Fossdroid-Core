<?php

namespace Melodycode\FossdroidBundle\Service;

class Utils {

    public function __construct() {
        
    }

    public function slugify($string) {
        $string = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $string);
        $string = preg_replace('/[-\s]+/', '-', $string);
        return trim($string, '-');
    }

    public function download($from, $to, $overwrite = false) {
        $file = basename($from);
        if ($overwrite || !file_exists($to . $file)) {
            if (@copy($from, $to . $file)) {
                return $to . $file;
            } else {
                return false;
            }
        }
        return false;
    }

    public function terms($string) {
        $string = strtolower($string);
        $_s = explode(' ', $string);

        $terms = array();
        foreach ($_s as $term) {
            $term = trim($term);
            $term = filter_var($term, FILTER_SANITIZE_STRING);

            if (strlen($term) > 2) {
                $terms[] = $term;
            }
        }

        return $terms;
    }

}
