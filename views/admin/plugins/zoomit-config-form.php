<h2>Admin Theme</h2>

<div class="field">
    <div id="zoomit_width_admin_label" class="two columns alpha">
        <label for="zoomit_width_admin">Viewer width, in pixels</label>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formText('zoomit_width_admin', get_option('zoomit_width_admin')); ?>
    </div>
</div>
<div class="field">
    <div id="zoomit_height_admin_label" class="two columns alpha">
        <label for="zoomit_height_admin">Viewer height, in pixels</label>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formText('zoomit_height_admin', get_option('zoomit_height_admin')); ?>
    </div>
</div>

<h2>Public Theme</h2>

<div class="field">
    <div id="zoomit_width_public_label" class="two columns alpha">
        <label for="zoomit_width_public">Viewer width, in pixels</label>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formText('zoomit_width_public', get_option('zoomit_width_public')); ?>
    </div>
</div>
<div class="field">
    <div id="zoomit_height_public_label" class="two columns alpha">
        <label for="zoomit_height_public">Viewer height, in pixels</label>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formText('zoomit_height_public', get_option('zoomit_height_public')); ?>
    </div>
</div>

<p>By using this service you acknowledge that you have read and agreed to the 
<a href="http://zoom.it/pages/terms/">Microsoft Zoom.it Terms of Service</a>.</p>
