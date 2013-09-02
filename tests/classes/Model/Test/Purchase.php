<?php

class Model_Test_Purchase extends Model_Purchase {

	public static function initialize(Jam_Meta $meta)
	{
		$meta->db(Kohana::TESTING);
		
		parent::initialize($meta);
	
		$meta->behaviors(array(
			'test_promotionable' => Jam::behavior('test_promotionable')
		));
		
		$meta->association('store_purchases')->foreign_model = 'test_store_purchase';
		$meta->association('creator')->foreign_model = 'test_user';
		$meta->association('payment')->foreign_model = 'test_payment';

		$meta->fields(array(
			'country' => Jam::field('string')
		));
	}
}