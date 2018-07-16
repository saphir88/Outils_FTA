<?php

namespace AppBundle\Service;

class RemoveHttp {

    /**
     * On recupère http:// pour le supprimer
     *
     * @param string $site
     * @return mixed
     */
    public function replaceHttp(string $site)
    {
        $youtubeWatch = array("http://");
        $youtubeEmbed = array("");

        return str_replace($youtubeWatch, $youtubeEmbed , $site);
    }
}