<?php

class Somecomp_Articles_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getImagePath($id = 0)
    {
        $path = Mage::getBaseDir('media') . '/somecomp_articles';
        if ($id) {
            return "{$path}/{$id}.jpg";
        } else {
            return $path;
        }
    }

    public function getImageUrl($id = 0)
    {
        $url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'somecomp_articles/';
        if ($id) {
            return $url . $id . '.jpg';
        } else {
            return $url;
        }
    }

    public function prepareUrl($url)
    {
        return trim(preg_replace('/-+/', '-', preg_replace('/[^a-z0-9]/sUi', '-', strtolower(trim($url)))), '-');
    }


}