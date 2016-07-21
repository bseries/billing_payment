<?php

use lithium\g11n\Message;

$t = function($message, array $options = []) {
	return Message::translate($message, $options + ['scope' => 'billing_payment', 'default' => $message]);
};

$this->set([
	'page' => [
		'type' => 'single',
		'title' => false,
		'empty' => false,
		'object' => $t('payment')
	]
]);

?>
<article>
	<?=$this->form->create($item) ?>
		<?php if ($item->exists()): ?>
			<?= $this->form->field('id', ['type' => 'hidden']) ?>
		<?php endif ?>

		<div class="grid-row">
			<div class="grid-column-left">
				<?= $this->form->field('date', [
					'type' => 'date',
					'label' => $t('Date'),
					'value' => $item->date ?: date('Y-m-d')
				]) ?>
				<div class="help"><?= $t('Date payment was received.') ?></div>

				<?= $this->form->field('method', [
					'type' => 'text',
					'label' => $t('Method')
				]) ?>

				<?= $this->form->field('amount_currency', [
					'type' => 'select',
					'label' => $t('Currency'),
					'list' => $currencies
				]) ?>

				<?= $this->form->field('amount', [
					'type' => 'text',
					'label' => $t('Amount'),
					'value' => $this->money->format($item->amount(), ['currency' => false]),
				]) ?>
			</div>
			<div class="grid-column-right">
				<?= $this->form->field('billing_invoice_id', [
					'type' => 'select',
					'label' => $t('Invoice'),
					'list' => $invoices
				]) ?>
				<?= $this->form->field('user_id', [
					'type' => 'select',
					'label' => $t('User'),
					'list' => $users
				]) ?>
			</div>
		</div>

		<div class="bottom-actions">
			<div class="bottom-actions__left">
				<?php if ($item->exists()): ?>
					<?= $this->html->link($t('delete'), [
						'action' => 'delete', 'id' => $item->id
					], ['class' => 'button large delete']) ?>
				<?php endif ?>
			</div>
			<div class="bottom-actions__right">
				<?= $this->form->button($t('save'), [
					'type' => 'submit',
					'class' => 'button large save'
				]) ?>
			</div>
		</div>

	<?=$this->form->end() ?>
</article>