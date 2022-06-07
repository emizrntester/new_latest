<?php

declare(strict_types=1);

namespace Zamoroka\WebapiDocuments\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Webapi\ServiceOutputProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;

class Customer implements ResolverInterface {
    protected $orderRepository;
    protected $searchCriteriaBuilder;
    protected $priceCurrency;
    public function __construct(
       \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
       \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
       \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
       CustomerFactory $customerFactory,
       CustomerRepositoryInterface $customerRepository


    ) {
       $this->orderRepository = $orderRepository;
       $this->searchCriteriaBuilder = $searchCriteriaBuilder;
       $this->priceCurrency = $priceCurrency;
        $this->customerFactory = $customerFactory;
         $this->customerRepository = $customerRepository;

    }
    /**
     * @inheritdoc
     */
    public function resolve(
       Field $field,
       $context,
       ResolveInfo $info,
       array $value = null,
       array $args = null
    ) {
       $customerId = $this->getCustomerId($args);
      echo $customerId;die;
       $customerOrderData = $this->getCustomerOrderData($customerId);
       return $customerOrderData;
    }
    /**
     * @param array $args
     * @return int
     * @throws GraphQlInputException
     */
    private function getCustomerId(array $args): int {
       if (!isset($args['customer_id'])) {
           throw new GraphQlInputException(__('Customer id should be specified'));
       }
       return (int) $args['customer_id'];
    }
    /**
     * @param int $customerId
     * @return array
     * @throws GraphQlNoSuchEntityException
     */
    private function getCustomerOrderData(int $customerId): array
    {
       try {
            $customerData = ['customerData'][];
            $customerColl = $this->customerFactory->create()->getCollection()
            >addFieldToFilter(“email”, [“eq”=>$customerId]);
             foreach ($customerColl as $customer) {               
               $customerOrder['customerData']['customer_name'] = $customer->getName();

               array_push($customerData, $customer->getData('name'));
               }
              // print_r($customerData);die;
       } catch (NoSuchEntityException $e) {
           throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
       }
      return isset($customerData[0])?$customerData[0]:[];
    }
}