<?php

use lithium\g11n\Message;

$t = function($message, array $options = []) {
	return Message::translate($message, $options + ['scope' => 'billing_payment', 'default' => $message]);
};

$this->set([
	'page' => [
		'type' => 'multiple',
		'object' => $t('payments')
	]
]);

?>
<article
	class="use-rich-index"
	data-endpoint="<?= $this->url([
		'action' => 'index',
		'page' => '__PAGE__',
		'orderField' => '__ORDER_FIELD__',
		'orderDirection' => '__ORDER_DIRECTION__',
		'filter' => '__FILTER__'
	]) ?>"
>

	<div class="top-actions">
		<?= $this->html->link($t('payment'), ['action' => 'add', 'library' => 'billing_payment'], ['class' => 'button add']) ?>
	</div>

	<?php if ($data->count()): ?>
		<table>
			<thead>
				<tr>
					<td data-sort="date" class="date table-sort"><?= $t('Date') ?>
					<td data-sort="method" class="method table-sort"><?= $t('Method') ?>
					<td data-sort="User.number" class="user table-sort"><?= $t('Payer') ?>
					<td data-sort="Invoice.number" class="invoice table-sort"><?= $t('On Invoice') ?>
					<td class="money"><?= $t('Amount') ?>
					<td data-sort="modified" class="date table-sort desc"><?= $t('Modified') ?>
					<td class="actions">
						<?= $this->form->field('search', [
							'type' => 'search',
							'label' => false,
							'placeholder' => $t('Filter'),
							'class' => 'table-search',
							'value' => $this->_request->filter
						]) ?>
			</thead>
			<tbody>
				<?php foreach ($data as $item): ?>
				<tr data-id="<?= $item->id ?>">
					<td class="date">
						<time datetime="<?= $this->date->format($item->date, 'w3c') ?>">
							<?= $this->date->format($item->date, 'date') ?>
						</time>
					<td class="method"><?= $item->method ?: '–' ?>
					<td class="user">
						<?= $this->user->link($item->user()) ?>
					<td class="invoice">
						<?php if ($invoice = $item->invoice()): ?>
							<?= $this->html->link($invoice->title(), [
								'controller' => 'Invoices',
								'action' => 'edit', 'id' => $invoice->id,
								'library' => 'billing_payment'
							]) ?>
						<?php else: ?>
							-
						<?php endif ?>
					<td class="money"><?= $this->money->format($item->amount()) ?>
					<td class="date modified">
						<time datetime="<?= $this->date->format($item->modified, 'w3c') ?>">
							<?= $this->date->format($item->modified, 'date') ?>
						</time>
					<td class="actions">
						<?= $this->html->link($t('open'), ['id' => $item->id, 'action' => 'edit', 'library' => 'billing_payment'], ['class' => 'button']) ?>
				<?php endforeach ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="none-available"><?= $t('No items available, yet.') ?></div>
	<?php endif ?>

	<?=$this->view()->render(['element' => 'paging'], compact('paginator'), ['library' => 'base_core']) ?>

	<div class="bottom-help">
		<?= $t('Payments may be associated with an invoice but do not have to. This is to cater for situations where you receive a payment that you can only associate with an invoice later.') ?>
	</div>

</article>