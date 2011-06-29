<?php
class Zoomit_IndexController extends Omeka_Controller_Action
{
    public function indexAction()
    {
        // Don't render the view script.
        $this->_helper->viewRenderer->setNoRender(true);
        
        // Get the file object.
        $file = get_db()->getTable('File')->find($this->_getParam('file-id'));
        
        // Request Zoom.it for the embed HTML.
        $client = new Zend_Http_Client('http://api.zoom.it/v1/content');
        $client->setParameterGet('url', $file->getWebPath('archive'));
        $response = json_decode($client->request()->getBody(), true);
        
        echo $response['embedHtml'];
    }
}
