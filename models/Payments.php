<?php
/**
 * Billing Payment
 *
 * Copyright (c) 2015 David Persson - All rights reserved.
 * Copyright (c) 2016 Atelier Disko - All rights reserved.
 *
 * Use of this source code is governed by a BSD-style
 * license that can be found in the LICENSE file.
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
}

?>