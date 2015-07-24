<?php
/**
 * Billing Payment
 *
 * Copyright (c) 2014 Atelier Disko - All rights reserved.
 *
 * This software is proprietary and confidential. Redistribution
 * not permitted. Unless required by applicable law or agreed to
 * in writing, software distributed on an "AS IS" BASIS, WITHOUT-
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 */

namespace billing_payment\config;

use AD\Finance\Money\Monies;
use AD\Finance\Money\MoniesIntlFormatter as MoniesFormatter;
use base_core\extensions\cms\Widgets;
use billing_payment\models\Payments;
use lithium\core\Environment;
use lithium\g11n\Message;

extract(Message::aliases());

Widgets::register('cashflow', function() use ($t) {
	$formatter = new MoniesFormatter(Environment::get('locale'));

	$paid = new Monies();
	$payments = Payments::find('all');

	foreach ($payments as $payment) {
		$paid = $paid->add($payment->amount());
	}

	return [
		'data' => [
			$t('received', ['scope' => 'billing_payment']) => $formatter->format($paid)
		]
	];
}, [
	'type' => Widgets::TYPE_COUNTER,
	'group' => Widgets::GROUP_DASHBOARD
]);

?>