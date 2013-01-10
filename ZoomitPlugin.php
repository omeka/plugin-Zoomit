<?php
/**
 * Zoom.it
 * 
 * @copyright Copyright 2007-2012 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * The Zoom.it plugin.
 * 
 * @package Omeka\Plugins\Zoomit
 */
class ZoomitPlugin extends Omeka_Plugin_AbstractPlugin
{
    const API_URL = 'http://api.zoom.it/v1/content';
    
    const DEFAULT_VIEWER_WIDTH = 500;
    
    const DEFAULT_VIEWER_HEIGHT = 600;
    
    protected $_hooks = array(
        'install', 
        'uninstall', 
        'initialize', 
        'config_form', 
        'config', 
        'admin_items_show', 
        'public_items_show', 
    );
    
    protected $_options = array(
        'zoomit_width_admin' => self::DEFAULT_VIEWER_WIDTH, 
        'zoomit_height_admin' => self::DEFAULT_VIEWER_HEIGHT, 
        'zoomit_width_public' => self::DEFAULT_VIEWER_WIDTH, 
        'zoomit_height_public' => self::DEFAULT_VIEWER_HEIGHT, 
    );
    
    /**
     * Install the plugin.
     */
    public function hookInstall()
    {
        $this->_installOptions();
    }
   
    /**
     * Unnstall the plugin.
     */
    public function hookUninstall()
    {
        $this->_uninstallOptions();
    }
    
    /**
     * Initialize the plugin.
     */
    public function hookInitialize()
    {
        // Add the view helper directory to the stack.
        get_view()->addHelperPath(dirname(__FILE__) . '/views/helpers', 'Zoomit_View_Helper_');
    }
    
    /**
     * Display the config form.
     */
    public function hookConfigForm()
    {
        echo get_view()->partial('plugins/zoomit-config-form.php');
    }
    
    /**
     * Handle the config form.
     */
    public function hookConfig()
    {
        if (!is_numeric($_POST['zoomit_width_admin']) || 
            !is_numeric($_POST['zoomit_height_admin']) || 
            !is_numeric($_POST['zoomit_width_public']) || 
            !is_numeric($_POST['zoomit_height_public'])) {
            throw new Omeka_Validate_Exception('The width and height must be numeric.');
        }
        set_option('zoomit_width_admin', $_POST['zoomit_width_admin']);
        set_option('zoomit_height_admin', $_POST['zoomit_height_admin']);
        set_option('zoomit_width_public', $_POST['zoomit_width_public']);
        set_option('zoomit_height_public', $_POST['zoomit_height_public']);
    }
    
    /**
     * Display the image viewer in admin items/show.
     */
    public function hookAdminItemsShow($args)
    {
        echo $args['view']->zoomit($args['item']->Files, 
                                   get_option('zoomit_width_admin'), 
                                   get_option('zoomit_height_admin'));
    }
    
    /**
     * Display the image viewer in public items/show.
     */
    public function hookPublicItemsShow($args)
    {
        echo $args['view']->zoomit($args['item']->Files, 
                                   get_option('zoomit_width_public'), 
                                   get_option('zoomit_height_public'));
    }
}
