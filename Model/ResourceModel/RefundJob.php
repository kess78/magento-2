<?php
/**
 * PostFinance Checkout Magento 2
 *
 * This Magento 2 extension enables to process payments with PostFinance Checkout (https://postfinance.ch/en/business/products/e-commerce/postfinance-checkout-all-in-one.html/).
 *
 * @package PostFinanceCheckout_Payment
 * @author wallee AG (http://www.wallee.com/)
 * @license http://www.apache.org/licenses/LICENSE-2.0  Apache Software License (ASL 2.0)
 */
namespace PostFinanceCheckout\Payment\Model\ResourceModel;

use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use PostFinanceCheckout\Payment\Api\Data\RefundJobInterface;
use PostFinanceCheckout\Sdk\ObjectSerializer;

/**
 * Transaction Info Resource Model
 */
class RefundJob extends AbstractDb
{

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'postfinancecheckout_payment_refund_job_resource';

    /**
     * Serializable fields
     *
     * @var array
     */
    protected $_serializableFields = [
        'refund' => [
            null,
            null
        ]
    ];

    /**
     *
     * @var ObjectSerializer
     */
    private $objectSerializer;

    /**
     *
     * @param Context $context
     * @param ObjectSerializer $objectSerializer
     * @param string $connectionName
     */
    public function __construct(Context $context, ObjectSerializer $objectSerializer, $connectionName = null)
    {
        parent::__construct($context, $connectionName);
        $this->objectSerializer = $objectSerializer;
    }

    /**
     * Model initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('postfinancecheckout_payment_refund_job', 'entity_id');
    }

    protected function _serializeField(DataObject $object, $field, $defaultValue = null, $unsetEmpty = false)
    {
        if ($field == RefundJobInterface::REFUND) {
            $value = $object->getData($field);
            if (empty($value) && $unsetEmpty) {
                $object->unsetData($field);
            } else {
                $object->setData($field,
                    $this->getSerializer()
                        ->serialize($this->objectSerializer->sanitizeForSerialization($value) ?: $defaultValue));
            }

            return $this;
        } else {
            return parent::_serializeField($object, $field, $defaultValue, $unsetEmpty);
        }
    }

    protected function _unserializeField(DataObject $object, $field, $defaultValue = null)
    {
        if ($field == RefundJobInterface::REFUND) {
            $value = $object->getData($field);
            if ($value) {
                $rawValue = json_decode($object->getData($field));
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \InvalidArgumentException('Unable to unserialize value.');
                }
                $value = $this->objectSerializer->deserialize($rawValue,
                    '\PostFinanceCheckout\Sdk\Model\RefundCreate');
                if (empty($value)) {
                    $object->setData($field, $defaultValue);
                } else {
                    $object->setData($field, $value);
                }
            } else {
                $object->setData($field, $defaultValue);
            }
        } else {
            return parent::_unserializeField($object, $field, $defaultValue);
        }
    }
}