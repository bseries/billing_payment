ALTER TABLE `billing_payments` DROP `virtual_user_id`;
ALTER TABLE `billing_payments` CHANGE `user_id` `user_id` INT(11)  UNSIGNED  NOT NULL;
