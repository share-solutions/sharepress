<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 24/03/2017
 * Time: 11:27
 */

namespace share\SharePress\Http;

class URL {
    /**
     *
     * http://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
     *
     * @param $text
     * @return mixed|string
     */
    public function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
