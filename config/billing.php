<?php
/**
 * Billing Payment
 *
 * Copyright (c) 2016 Atelier Disko - All rights reserved.
 *
 * Licensed under the AD General Software License v1.
 *
 * This software is proprietary and confidential. Redistribution
 * not permitted. Unless required by applicable law or agreed to
 * in writing, software distributed on an "AS IS" BASIS, WITHOUT-
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *
 * You should have received a copy of the AD General Software
 * License. If not, see http://atelierdisko.de/licenses.
 */

namespace billing_payment\config;

use lithium\g11n\Message;
use billing_payment\billing\payment\Gateway;
use billing_payment\billing\payment\Method;

extract(Message::aliases());

Gateway::config('banqueInvoice', [
	'title' => 'Banque Invoice',
	'adapter' => 'BanqueInvoice'
]);
Gateway::config('banquePrepayment', [
	'title' => 'Banque Invoice',
	'adapter' => 'BanquePrepayment'
]);

//
// Payment Methods
//
$infoBankAccount = function($context, $format) {
	$data = Settings::read('billing.bankAccount');

	$result   = [];
	$result[] = $data['holder'];
	$result[] = $data['bank'];
	$result[] = null;
	$result[] = "IBAN {$data['iban']}";
	$result[] = "BIC {$data['bic']}";

	if ($format === 'html') {
		return '<pre>' . implode("\n", $result) . '</pre>';
	}
	return implode("\n", $result);
};
Method::config('banqueInvoice', [
	'gateway' => 'banqueInvoice',
	'title' => function() use ($t) {
		return $t('Invoice', ['scope' => 'billing_core']);
	},
	'info' => function($context, $format) use ($t, $infoBankAccount) {
		$output = '';

		if ($context === 'checkout.payment') {
			$intro = 'Nach Erhalt der Rechnung überweisen Sie den Gesamtbetrag auf unser Bankkonto.';
		} else {
			$intro = 'Überweisen Sie den noch offenen Gesamtbetrag nun auf folgendes Konto:';
		}
		if ($format === 'html') {
			$output .= "<p>{$intro}</p>";
		} else {
			$output .= "\n{$intro}\n\n";
		}
		if ($context != 'checkout.payment') {
			$output .= $infoBankAccount($context, $format);
		}
		return $output;
	}
]);

Method::config('banuqePrepayment', [
	'gateway' => 'banquePrepayment',
	'title' => function() use ($t) {
		return $t('Prepayment', ['scope' => 'billing_core']);
	},
	'info' => function($context, $format) use ($t, $infoBankAccount) {
		$output = '';

		if ($context === 'checkout.payment') {
			$intro = 'Nach Bestätigung der Bestellung können Sie den Betrag überweisen.';
		} else {
			$intro  = 'Überweisen Sie den Gesamtbetrag unter Nennung Ihrer Bestellnummer auf folgendes Konto. ';
			$intro .= 'Sobald wir Ihre Zahlung erhalten und verbucht haben, senden wir Ihnen eine Zahlungsbestätigung per E–Mail ';
			$intro .= 'und geben Ihre Bestellung umgehend in den Versand.';
		}
		if ($format === 'html') {
			$output .= "<p>{$intro}</p>";
		} else {
			$output .= "\n{$intro}\n\n";
		}

		if ($context != 'checkout.payment') {
			$output .= $infoBankAccount($context, $format);
		}
		return $output;
	}
]);

?>