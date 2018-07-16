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
        $httpWatch = array("http://");
        $httpsWatch = array("https://");
        $httpEmbed = array("");
        if (preg_match("/http:\/\//i", $site)) {
            return str_replace($httpWatch, $httpEmbed , $site);
        } elseif (preg_match("/https:\/\//i", $site)){
            return str_replace($httpsWatch, $httpEmbed , $site);
        }
        return $site;

    }
}