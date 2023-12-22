<?php
namespace App\Helpers;


use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TinTucUtils
{
    public static function findAndReplaceImg($htmlString)
    {
        //Create a new DOMDocument object.
        $htmlDom = new \DOMDocument();

        libxml_use_internal_errors(true);

        //Load the HTML string into our DOMDocument object.
        $htmlDom->loadHTML($htmlString);

        //Extract all img elements / tags from the HTML.
        $imageTags = $htmlDom->getElementsByTagName('img');

        //Create an array to add extracted images to.
        $extractedImages = array();

        //Loop through the image tags that DOMDocument found.
        foreach($imageTags as $imageTag){

            //Get the src attribute of the image.
            $imgSrc = $imageTag->getAttribute('src');

            $imgSrcURL = parse_url($imgSrc);

            if (empty($imgSrcURL['scheme'])) {
                $htmlString = str_replace($imgSrc, 'https://bacgiang.gov.vn' . $imgSrc, $htmlString);
            }

        }

        return $htmlString;
    }

    public static function findAndReplaceHref($htmlString)
    {
        //Create a new DOMDocument object.
        $htmlDom = new \DOMDocument();

        libxml_use_internal_errors(true);

        //Load the HTML string into our DOMDocument object.
        $htmlDom->loadHTML($htmlString);

        //Extract the links from the HTML.
        $links = $htmlDom->getElementsByTagName('a');

        //Array that will contain our extracted links.
        $extractedLinks = array();

        //Loop through the DOMNodeList.
        //We can do this because the DOMNodeList object is traversable.
        foreach($links as $link){

            //Get the link text.
            $linkText = $link->nodeValue;
            //Get the link in the href attribute.
            $linkHref = $link->getAttribute('href');

            //If the link is empty, skip it and don't
            //add it to our $extractedLinks array
            if(strlen(trim($linkHref)) == 0){
                continue;
            }

            //Skip if it is a hashtag / anchor link.
            if($linkHref[0] == '#'){
                continue;
            }

            $linkURL = parse_url($linkHref);

            if (empty($linkURL['scheme'])) {
                $htmlString = str_replace($linkHref, 'https://bacgiang.gov.vn' . $linkHref, $htmlString);
            }

        }

        return $htmlString;
    }


    public static function findAndReplaceImgAndHref($htmlString)
    {
        //Create a new DOMDocument object.
        $htmlDom = new \DOMDocument();

        libxml_use_internal_errors(true);

        //Load the HTML string into our DOMDocument object.
        $htmlDom->loadHTML($htmlString);

        //Extract all img elements / tags from the HTML.
        $imageTags = $htmlDom->getElementsByTagName('img');

        //Extract the links from the HTML.
        $links = $htmlDom->getElementsByTagName('a');

        //Create an array to add extracted images to.
        $extractedImages = array();
        //Array that will contain our extracted links.
        $extractedLinks = array();

        //Loop through the image tags that DOMDocument found.
        foreach($imageTags as $imageTag){

            //Get the src attribute of the image.
            $imgSrc = $imageTag->getAttribute('src');

            $imgSrcURL = parse_url($imgSrc);

            if (empty($imgSrcURL['scheme'])) {
                $htmlString = str_replace($imgSrc, 'https://bacgiang.gov.vn' . $imgSrc, $htmlString);
            }

        }

        //Loop through the DOMNodeList.
        //We can do this because the DOMNodeList object is traversable.
        foreach($links as $link){

            //Get the link text.
            $linkText = $link->nodeValue;
            //Get the link in the href attribute.
            $linkHref = $link->getAttribute('href');

            //If the link is empty, skip it and don't
            //add it to our $extractedLinks array
            if(strlen(trim($linkHref)) == 0){
                continue;
            }

            //Skip if it is a hashtag / anchor link.
            if($linkHref[0] == '#'){
                continue;
            }

            $linkURL = parse_url($linkHref);

            if (empty($linkURL['scheme'])) {
                $htmlString = str_replace($linkHref, 'https://bacgiang.gov.vn' . $linkHref, $htmlString);
            }

        }

        return $htmlString;
    }
}
