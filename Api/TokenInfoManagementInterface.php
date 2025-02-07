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

use PostFinanceCheckout\Payment\Model\TokenInfo;

/**
 * Token info management interface.
 *
 * @api
 */
interface TokenInfoManagementInterface
{

    /**
     * Fetches the token version's latest state from PostFinance Checkout and updates the stored information.
     *
     * @param int $spaceId
     * @param int $tokenVersionId
     */
    public function updateTokenVersion($spaceId, $tokenVersionId);

    /**
     * Fetches the token's latest state from PostFinance Checkout and updates the stored information.
     *
     * @param int $spaceId
     * @param int $tokenId
     */
    public function updateToken($spaceId, $tokenId);

    /**
     * Deletes the token on PostFinance Checkout.
     *
     * @param Data\TokenInfoInterface $token
     */
    public function deleteToken(TokenInfo $token);
}