<?php
declare(strict_types=1);

namespace Emizentech\Categoryfilterapi\Model\Resolver;
use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\Resolver\ValueFactory;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Webapi\ServiceOutputProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;

/**
 * Customers field resolver, used for GraphQL request processing.
 */

class Categorylayer implements ResolverInterface
{
    /**
     * @var ValueFactory
     */
    private $valueFactory;

    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    /**
     * @var ServiceOutputProcessor
     */
    private $serviceOutputProcessor;

    /**
     * @var ExtensibleDataObjectConverter
     */
    private $dataObjectConverter;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     *
     * @param ValueFactory $valueFactory
     * @param CustomerFactory $customerFactory
     * @param ServiceOutputProcessor $serviceOutputProcessor
     * @param ExtensibleDataObjectConverter $dataObjectConverter
     */
    public function __construct(
        ValueFactory $valueFactory,
        CustomerFactory $customerFactory,
        ServiceOutputProcessor $serviceOutputProcessor,
        ExtensibleDataObjectConverter $dataObjectConverter,
        CustomerRepositoryInterface $customerRepository,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->valueFactory = $valueFactory;
        $this->customerFactory = $customerFactory;
        $this->serviceOutputProcessor = $serviceOutputProcessor;
        $this->dataObjectConverter = $dataObjectConverter;
        $this->customerRepository = $customerRepository;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)  {
        if (!isset($args['category_id'])) {
            throw new GraphQlAuthorizationException(
                __(
                    'category_id for  should be specified',
                    [\Magento\Customer\Model\Customer::ENTITY]
                )
            );
        }
        try {
            
               $category = $args['category_id'];

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $filterableAttributes = $objectManager->getInstance()->get(\Magento\Catalog\Model\Layer\Category\FilterableAttributeList::class);

        $appState = $objectManager->getInstance()->get(\Magento\Framework\App\State::class);
        $layerResolver = $objectManager->getInstance()->get(\Magento\Catalog\Model\Layer\Resolver::class);
        $filterList = $objectManager->getInstance()->create(
            \Magento\Catalog\Model\Layer\FilterList::class,
                [
                    'filterableAttributes' => $filterableAttributes
                ]
            );      

            $layer = $layerResolver->get();
            $layer->setCurrentCategory($category);
            $filters = $filterList->getFilters($layer);
            $maxPrice = $layer->getProductCollection()->getMaxPrice();
            $minPrice = $layer->getProductCollection()->getMinPrice();  

        $i = 0;
       foreach($filters as $filter)
       {
           //$availablefilter = $filter->getRequestVar(); //Gives the request param name such as 'cat' for Category, 'price' for Price
           $availablefilter = (string)$filter->getName(); //Gives Display Name of the filter such as Category,Price etc.
           $items = $filter->getItems(); //Gives all available filter options in that particular filter
           $filterValues = array();
           $j = 0;
           foreach($items as $item)
           {
           // echo "<pre>";
           // print_r($item->getLabel());die;

               $filterValues[$j]['display'] = $item->getLabel();
               $filterValues[$j]['value']   = $item->getValue();
               $filterValues[$j]['count']   = $item->getCount(); //Gives no. of products in each filter options
               $j++;
           }
           if(!empty($filterValues) && count($filterValues)>1)
           {
               $filterArray['availablefilter'][$availablefilter] =  $filterValues;
           }
           $i++;
       }  




         echo json_encode($filterArray, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );// str_replace('\/','/',json_encode($data)); 
        exit();
      // print_r($filterArray);die;
             //  return json_encode($filterArray);

       //return  $filterArray;
        //return json_encode($filterArray);
           // return $this->valueFactory->create($filterArray);
        } catch (NoSuchEntityException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        } catch (LocalizedException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        }
    }

    /**
     *
     * @param int $context
     * @return array
     * @throws NoSuchEntityException|LocalizedException
     */
    private function getCustomerData($category_id) : array
    {
        try {
               $customerData = [];


      



            // $customerColl = $this->customerFactory->create()->getCollection()->addFieldToFilter('email', ['eq'=>$customerEmail]);
            // foreach ($customerColl as $customer) {
            //     array_push($customerData, $customer->getData());
            // }
            // return isset($customerData[0])?$customerData[0]:[];
        } catch (NoSuchEntityException $e) {
            return [];
        } catch (LocalizedException $e) {
            throw new NoSuchEntityException(__($e->getMessage()));
        }
    }
}