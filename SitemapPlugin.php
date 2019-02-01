<?php
/**
 * Omeka Sitemap Plugin
 *
 * @author John Kloor <kloor@bgsu.edu>
 * @copyright 2015 Bowling Green State University Libraries
 * @license MIT
 */

/**
 * Omeka Sitemap Plugin: Plugin Class
 *
 * @package Sitemap
 */
class SitemapPlugin extends Omeka_Plugin_AbstractPlugin
{
    /**
     * @var array Plugin hooks.
     */
    protected $_hooks = array(
        'define_routes'
    );

    /**
     * Hook to define routes.
     *
     * Adds a route for the sitemap.xml file.
     */
    public function hookDefineRoutes($args)
    {
        $router = $args['router'];

        $router->addRoute(
            'sitemap_xml',
            new Zend_Controller_Router_Route(
                'sitemap.xml',
                array(
                    'module' => 'sitemap',
                    'controller' => 'xml',
                    'action' => 'index'
                )
            )
        );
    }
}
