<?php
require_once 'Omeka/Plugin/Abstract.php';
class ZoomitPlugin extends Omeka_Plugin_Abstract
{
    const DEFAULT_VIEWER_WIDTH = 500;
    const DEFAULT_VIEWER_HEIGHT = 600;
    
    protected $_hooks = array(
        'install', 
        'uninstall', 
        'config_form', 
        'config', 
        'admin_append_to_items_show_primary', 
        'public_append_to_items_show', 
    );
    
    protected $_supportedExtensions = array('bmp', 'gif', 'ico', 'jpeg', 'jpg', 
                                            'png', 'tiff', 'tif');
    
    public function hookInstall()
    {
        set_option('zoomit_width_admin', ZoomitPlugin::DEFAULT_VIEWER_WIDTH);
        set_option('zoomit_height_admin', ZoomitPlugin::DEFAULT_VIEWER_HEIGHT);
        set_option('zoomit_width_public', ZoomitPlugin::DEFAULT_VIEWER_WIDTH);
        set_option('zoomit_height_public', ZoomitPlugin::DEFAULT_VIEWER_HEIGHT);
    }
   
    public  function hookUninstall()
    {
        delete_option('zoomit_width_admin');
        delete_option('zoomit_height_admin');
        delete_option('zoomit_width_public');
        delete_option('zoomit_height_public');
     }
    
    public function hookConfigForm()
    {
        include 'config_form.php';
    }
    
    public function hookConfig()
    {
        if (!is_numeric($_POST['zoomit_width_admin']) || 
            !is_numeric($_POST['zoomit_height_admin']) || 
            !is_numeric($_POST['zoomit_width_public']) || 
            !is_numeric($_POST['zoomit_height_public'])) {
            throw new Omeka_Validator_Exception('The width and height must be numeric.');
        }
        set_option('zoomit_width_admin', $_POST['zoomit_width_admin']);
        set_option('zoomit_height_admin', $_POST['zoomit_height_admin']);
        set_option('zoomit_width_public', $_POST['zoomit_width_public']);
        set_option('zoomit_height_public', $_POST['zoomit_height_public']);
    }
    
    public function hookAdminAppendToItemsShowPrimary()
    {
        $this->append();
    }
    
    public function hookPublicAppendToItemsShow()
    {
        $this->append();
    }
    
    public function append()
    {
        // Get valid images.
        $images = array();
        foreach (__v()->item->Files as $file) {
            $extension = pathinfo($file->archive_filename, PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), $this->_supportedExtensions)) {
                continue;
            }
            $images[] = $file;
        }
        if (empty($images)) {
            return;
        }
?>
<script type="text/javascript">
jQuery(document).ready(function () {
    var imageviewer = jQuery('#zoomit_imageviewer');
    jQuery('.zoomit_images').click(function(event) {
        event.preventDefault();
        imageviewer.empty();
        imageviewer.append(
        '<h2>Viewing: ' + jQuery(this).text() + '</h2>' 
      + '<iframe src="' + this.href + '" ' 
      + 'width="<?php echo is_admin_theme() ? get_option('zoomit_width_admin') : get_option('zoomit_width_public'); ?>" ' 
      + 'height="<?php echo is_admin_theme() ? get_option('zoomit_height_admin') : get_option('zoomit_height_public'); ?>" ' 
      + 'style="border: none;"></iframe>');
    });
});
</script>
<div>
    <h2>Image Viewer</h2>
    <p>Click below to view an image using the <a href="http://zoom.it/">Zoom.it</a> viewer.</p>
    <ul>
        <?php foreach($images as $image): ?>
        <li><a href="<?php echo html_escape(__v()->url('zoomit/index/index/file-id/' . $image->id)); ?>" class="zoomit_images"><?php echo html_escape($image->original_filename); ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<div id="zoomit_imageviewer"></div>
<?php
    }
}
