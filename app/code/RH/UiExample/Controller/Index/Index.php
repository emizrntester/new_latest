<?php
namespace RH\UiExample\Controller\Index;

   class Index extends \Magento\Framework\App\Action\Action

    {
        protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
            
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        // $this->_view->loadLayout();
    
        // $this->_view->renderLayout();

                // print_r("expression");die("asdfasd");
        return $this->_pageFactory->create();    
    }

}

?>

