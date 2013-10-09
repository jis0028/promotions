<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * @package    openbuildings\promotions
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2013 OpenBuildings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
class Kohana_Jam_Validator_Rule_Purchase_Promocode extends Jam_Validator_Rule {

	public function validate(Jam_Validated $model, $attribute, $value)
	{
		$promo_code = $this->valid_promo_code($value, $model);

		if ($promo_code)
		{
			$promo_code->validate_purchase($model);
		}
		else
		{
			$model->errors()->add('promo_code_text', 'invalid');
		}
	}

	public function valid_promo_code($code, Model_Purchase $purchase)
	{
		return Jam::all('promo_code')
			->where('code', '=', $code)
			->not_expired()
			->available_for_purchase($purchase)
			->first();
	}
}