<?php

namespace Emizen\Codetest\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {

        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}