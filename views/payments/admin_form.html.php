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
		<?= $this->form->field('id', ['type' => 'hidden']) ?>

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
				<div class="compound-users">
					<?php
						$user = $item->exists() ? $item->user() : false;
					?>
					<?= $this->form->field('user_id', [
						'type' => 'select',
						'label' => $t('User'),
						'list' => $users,
						'class' => !$user || !$user->isVirtual() ? null : 'hide'
					]) ?>
					<?= $this->form->field('virtual_user_id', [
						'type' => 'select',
						'label' => false,
						'list' => $virtualUsers,
						'class' => $user && $user->isVirtual() ? null : 'hide'
					]) ?>
					<?= $this->form->field('user.is_real', [
						'type' => 'checkbox',
						'label' => $t('real user'),
						'checked' => $user ? !$user->isVirtual() : true
					]) ?>
				</div>
			</div>
		</div>
		<div class="bottom-actions">
			<?= $this->form->button($t('save'), ['type' => 'submit', 'class' => 'save large']) ?>
		</div>
	<?=$this->form->end() ?>
</article>