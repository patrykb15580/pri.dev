<?php
/**
* 
*/
class PromotionCode extends Model
{
	public $id, $code, $created_at, $updated_at, $package_id, $used, $client_id;

	const STATUSES = 	['active' => 'Aktywne',
						'inactive' => 'Nieaktywne'];

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'code'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'unique']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'package_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'used'					=>['type' => 'boolean',
									   'default' => false],
			'client_id'				=>['type' => 'integer',
									   'default' => null]
		];
	}
	public static function pluralizeClassName()
	{
		return 'PromotionCodes';
	}
	public function package()
	{
		return PromotionCodesPackage::find($this->package_id);
	}
	public function client()
	{
		return Client::find($this->client_id);
	}
	public function isActive()
	{
		$package = $this->package();
		$promotion_action = $package->promotion_action();
		#print_r($promotion_action->status."\n");
		#die(print_r($package->status));
		if ($package->status == 'active' && $promotion_action->status == 'active') {
			return true;
		} else {
			return false;
		}
	}
}