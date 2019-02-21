<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 28/11/18
 * Time: 16:47
 */

namespace App\Service;

/**
 * Class Link
 * @package App\Service
 */
class Link
{
    /**
     * @param string $input
     * @return string
     */
    public function generate(string $input): string
    {
        if (strpos($input, "dai") !== false) {
            $input = "https://www.dailymotion.com/embed/video/" . substr($input, (strrpos($input, "/") + 1));
        } elseif (strpos($input, "you") !== false) {
            $input = "https://www.youtube.com/embed/" . substr($input, (strrpos($input, "/") + 1));
        } else {
            $input = "https://player.vimeo.com/video/" . substr($input, (strrpos($input, "/") + 1));
        }
        return $input;
    }
}
