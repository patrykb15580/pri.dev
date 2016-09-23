<?php
/**
* 
*/
class Promotor extends Model
{
	public $id, $email, $password_degest, $created_at, $updated_at, $name;	

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'email'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'password_degest'		=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'name'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
		];
	}
	public static function pluralizeClassName()
	{
		return 'Promotors';
	}
	public function promotion_actions()
	{
		return PromotionAction::where('promotors_id=?', ['promotors_id'=>$this->id]);
	}
	public function rewards()
	{
		return Reward::where('promotors_id=?', ['promotors_id'=>$this->id]);
	}
	public function promotion_codes()
	{
		return PromotionCode::where('promotors_id=?', ['promotors_id'=>$this->id]);
	}
	public function clients()
	{
		$balances = PointsBalance::where('promotor_id=?', ['promotor_id'=>$this->id], ['order'=>'created_at DESC']);
		
		$clients = [];
		foreach ($balances as $balance) {
			$client = Client::find($balance->client_id);
			$clients[$client->id] = $client;
		}

		return $clients;
	}
}