<?php
/**
 * Omeka Sitemap Plugin: XML Controller
 *
 * @author John Kloor <kloor@bgsu.edu>
 * @copyright 2015 Bowling Green State University Libraries
 * @license MIT
 */

/**
 * Omeka Sitemap Plugin: XML Controller Class
 *
 * Produces the sitemap.xml file.
 *
 * @package Sitemap
 */
class Sitemap_XmlController extends Omeka_Controller_AbstractActionController
{
    public function indexAction()
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute(
            'xmlns',
            'http://www.sitemaps.org/schemas/sitemap/0.9'
        );

        $dom->appendChild($urlset);

        $items = get_db()->getTable('Item')->findBy(
            array('sort_field' => 'added', 'sort_dir' => 'a')
        );

        foreach ($items as $item) {
            $url = $dom->createElement('url');
            $urlset->appendChild($url);

            $loc = $dom->createElement(
                'loc',
                'https://'. $_SERVER['SERVER_NAME']. record_url($item)
            );

            $url->appendChild($loc);
        }

        header('Content-Type: text/xml');
        echo $dom->saveXML();
        exit();
    }
}
