<?php
/**
 * Billing Payment
 *
 * Copyright (c) 2016 Atelier Disko - All rights reserved.
 *
 * Use of this source code is governed by a BSD-style
 * license that can be found in the LICENSE file.
 */

namespace billing_payment\models;

use billing_payment\billing\payment\Methods;

class PaymentMeans extends \base_core\models\Base {

	protected $_meta = [
		'source' => 'billing_payment_means'
	];

	protected $_actsAs = [
		'base_core\extensions\data\behavior\RelationsPlus',
		'base_core\extensions\data\behavior\Timestamp'
	];

	public $belongsTo = [
		'User' => [
			'to' => 'base_core\models\Users',
			'key' => 'user_id'
		]
	];

	public function method($entity) {
		return Methods::registry($entity->payment_method);
	}
}

?>