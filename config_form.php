<h3>Admin Interface</h3>
<label for="zoomit_width_admin">Viewer width, in pixels:</label>
<p><?php echo __v()->formText('zoomit_width_admin', 
                              get_option('zoomit_width_admin'), 
                              array('size' => 5));?></p>
<label for="zoomit_height_admin">Viewer height, in pixels:</label>
<p><?php echo __v()->formText('zoomit_height_admin', 
                              get_option('zoomit_height_admin'), 
                              array('size' => 5));?></p>
<h3>Public Theme</h3>
<label for="zoomit_width_public">Viewer width, in pixels:</label>
<p><?php echo __v()->formText('zoomit_width_public', 
                              get_option('zoomit_width_public'), 
                              array('size' => 5));?></p>
<label for="zoomit_height_public">Viewer height, in pixels:</label>
<p><?php echo __v()->formText('zoomit_height_public', 
                              get_option('zoomit_height_public'), 
                              array('size' => 5));?></p>
<p>By using this service you acknowledge that you have read and agreed to the 
<a href="http://zoom.it/pages/terms/">Microsoft Zoom.it Terms of Service</a>.</p>