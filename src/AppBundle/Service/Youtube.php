<?php
namespace AppBundle\Service;

/**
 * Class Youtube
 * @package AppBundle\Service
 */
class Youtube{

    /**
     * Modifie le lien d'une vidéo de "watch" à "embed" afin qu'elle puisse être visible correctement dans la vue.
     *
     * @param string $video
     * @return string
     */
    public function replaceVideo(string $video)
    {
        $youtubeWatch = array("/watch?v=");
        $youtubeEmbed = array("/embed/");

        return str_replace($youtubeWatch, $youtubeEmbed , $video);
    }
}
