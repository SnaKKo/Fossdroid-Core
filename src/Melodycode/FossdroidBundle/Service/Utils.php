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

    function clearInvalidUTF8($string) {
        // remove emoji (https://stackoverflow.com/questions/35961245/how-to-remove-all-emoji-from-string-php)
        return preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $string);
    }

}
