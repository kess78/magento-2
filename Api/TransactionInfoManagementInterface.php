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
namespace PostFinanceCheckout\Payment\Api;

use Magento\Sales\Model\Order;
use PostFinanceCheckout\Sdk\Model\Transaction;

/**
 * Transaction info management interface.
 *
 * @api
 */
interface TransactionInfoManagementInterface
{

    /**
     * Stores the transaction data in the database.
     *
     * @param Transaction $transaction
     * @param Order $order
     * @return Data\TransactionInfoInterface
     */
    public function update(Transaction $transaction, Order $order);
}