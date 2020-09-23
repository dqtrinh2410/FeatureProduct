<?php
namespace AHT\FeatureProduct\Block\Adminhtml\Feature\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Xóa '),
            'on_click' => 'deleteConfirm(\'' . __('Bạn có chắc chắn muốn xóa sản phẩm Feature này ?') . '\', \'' . $this->getDeleteUrl() . '\')',
            'class' => 'delete',
            'sort_order' => 20
        ];
    }

    public function getDeleteUrl()
    {
        $urlInterface = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\UrlInterface');
        $url = $urlInterface->getCurrentUrl();

        $parts = explode('/', parse_url($url, PHP_URL_PATH));
//        print_r($parts);die();
        $id = $parts[7];
        //print_r($id);die();
        return $this->getUrl('*/*/delete', ['feature_id' => $id]);
    }
}
