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

namespace billing_payment\models;

use AD\Finance\Money;

class Payments extends \base_core\models\Base {

	protected $_meta = [
		'source' => 'billing_payments'
	];

	protected $_actsAs = [
		'base_core\extensions\data\behavior\RelationsPlus',
		'base_core\extensions\data\behavior\Timestamp',
		'base_core\extensions\data\behavior\Localizable' => [
			'fields' => [
				'amount' => 'money'
			]
		],
		'base_core\extensions\data\behavior\Searchable' => [
			'fields' => [
				'method',
				'date',
				'User.number',
				'Invoice.number'
			]
		]
	];

	public $belongsTo = [
		'User' => [
			'to' => 'base_core\models\Users',
			'key' => 'user_id'
		],
		'Invoice' => [
			'to' => 'billing_invoice\models\Invoices',
			'key' => 'billing_invoice_id'
		]
	];

	public function amount($entity) {
		return new Money((integer) $entity->amount, $entity->amount_currency);
	}

	/* Deprecated */

	public function totalAmount($entity) {
		trigger_error("Payments::totalAmount() is deprecated in favor of Payments::amount()", E_USER_DEPRECATED);
		return $entity->amount();
	}
}

?>