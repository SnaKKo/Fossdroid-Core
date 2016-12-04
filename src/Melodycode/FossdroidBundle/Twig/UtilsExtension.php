<?php

namespace Melodycode\FossdroidBundle\Twig;

class UtilsExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('isDark', array($this, 'isDark')),
        );
    }

    /**
     * Check if the color is dark.
     * 
     * @param string $bg HEX color
     * @return boolean
     */
    
    public function isDark($bg) {
        $bg = str_replace('#', '', $bg);

        $r = hexdec(substr($bg, 0, 2));
        $g = hexdec(substr($bg, 2, 2));
        $b = hexdec(substr($bg, 4, 2));

        return (( $r * 299 + $g * 587 + $b * 114 ) / 1000 <= 130);
    }

    public function getName() {
        return 'utils_extension';
    }

}
