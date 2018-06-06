<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 06/06/18
 * Time: 10:48
 */
namespace AppBundle\Service;

class Youtube{

    public function replaceVideo($video)
    {

        $youtubeWatch = array("https://www.youtube.com/watch?v=");
        $youtubeEmbed   = array("https://www.youtube.com/embed/");
        $replace = str_replace($youtubeWatch, $youtubeEmbed , $video);

        return $replace;
    }
}
