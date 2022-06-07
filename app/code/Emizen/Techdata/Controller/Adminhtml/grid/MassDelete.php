<?php
namespace Emizen\Techdata\Controller\Adminhtml\Grid;
use Magento\Backend\App\Action;

/**
 * Class MassDelete
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $itemIds = $this->getRequest()->getParam('techdata');
        if (!is_array($itemIds) || empty($itemIds)) {
            $this->messageManager->addError(__('Please select item(s).'));
        } else {
            try {
        // die("asd");
                foreach ($itemIds as $itemId) {
                    $post = $this->_objectManager->get('Emizen\Techdata\Model\Test')->load($itemId);
                        print_r($itemIds);
                        // die("dfsgad");
                    $post->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($itemIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('techdata/*/index');
    }
}