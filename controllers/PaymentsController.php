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

namespace billing_payment\controllers;

use base_core\models\Users;
use billing_invoice\models\Invoices;
use billing_payment\models\Payments;
use billing_core\models\Currencies;
use lithium\g11n\Message;
use li3_flash_message\extensions\storage\FlashMessage;

class PaymentsController extends \base_core\controllers\BaseController {

	use \base_core\controllers\AdminIndexTrait;
	use \base_core\controllers\AdminAddTrait;
	use \base_core\controllers\AdminEditTrait;
	use \base_core\controllers\AdminDeleteTrait;

	protected function _selects($item = null) {
		$users = [null => '-'] + Users::find('list', ['order' => 'name']);

		$invoices = [null => '-'] + Invoices::find('list');
		$currencies = Currencies::find('list');

		return compact('currencies', 'invoices', 'users');
	}
}

?>