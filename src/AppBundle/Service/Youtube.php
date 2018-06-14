<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 06/06/18
 * Time: 10:48
 */
namespace AppBundle\Service;

class Youtube{

    public function replaceVideo(string $video)
    {

        $youtubeWatch = array("/watch?v=");
        $youtubeEmbed   = array("/embed/");

        $replace = str_replace($youtubeWatch, $youtubeEmbed , $video);

        return $replace;
    }
}
