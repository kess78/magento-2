/**
 * PostFinance Checkout Magento 2
 *
 * This Magento 2 extension enables to process payments with PostFinance Checkout (https://postfinance.ch/en/business/products/e-commerce/postfinance-checkout-all-in-one.html/).
 *
 * @package PostFinanceCheckout_Payment
 * @author wallee AG (http://www.wallee.com/)
 * @license http://www.apache.org/licenses/LICENSE-2.0  Apache Software License (ASL 2.0)
 */
define([
	'jquery',
	'mage/cookies'
], function(
	$
) {
	'use strict';
	
	function loadScript(options, identifier){
		if (options.scriptUrl && identifier) {
			$.getScript(options.scriptUrl + identifier);
		}
	}
	
	return function(options){
		var sessionIdentifier = $.mage.cookies.get('postfinancecheckout_device_id');
		if (sessionIdentifier) {
			loadScript(options, sessionIdentifier);
		} else {
			$.getJSON(options.identifierUrl).fail(function (jqXHR) {
                throw new Error(jqXHR);
            }).done(function(sessionIdentifier){
            	$.mage.cookies.set('postfinancecheckout_device_id', sessionIdentifier, { path: '/' });
            	loadScript(options, sessionIdentifier);
            });
		}
		
		
	}
});