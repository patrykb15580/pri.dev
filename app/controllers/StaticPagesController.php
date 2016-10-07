<?php
/**
* 
*/
class StaticPagesController extends Controller
{
	public function startPage()
	{
		(new View($this->params, [], 'start'))->render();
	}

	public function insertCode()
	{
		$code = CodeChecker::checkCodeExist($this->params);

		if ($code !== null && $code->isActive()) {
			$router = Config::get('router');
			$path = $router->generate('use_code', ['code'=>$this->params['code']]);
			header('Location: '.$path);
		}
		else{
			$router = Config::get('router');
			$path = $router->generate('startPage', []);
			header('Location: '.$path.'?error=code');
		}
	}

	public function useCode()
	{
		$code = PromotionCode::findBy('code', $this->params['code']);
		$package = $code->package();
		$promotion_action = $package->promotionAction();
		$promotor = $promotion_action->promotor();
		(new View($this->params, ['code'=>$code, 'package'=>$package, 'promotion_action'=>$promotion_action, 'promotor'=>$promotor], 'start'))->render();
	}

	public function addPoints()
	{
		$client = $this->getOrCreateClient($this->params);
		$code = PromotionCode::findBy('code', $this->params['code']);
		$package = $code->package();
		$promotion_action = $package->promotionAction();
		$promotor = $promotion_action->promotor();
		#echo "<pre>";
		#die(print_r($package));

		$code = PromotionCode::findBy('code', $this->params['code']);
		$code->update(['used'=>date(Config::get('mysqltime')), 'client_id'=>$client->id]);

		$points_balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$client->id, 'promotor_id'=>$promotor->id]);

		if (!empty($points_balance)) {
			$points_balance = $points_balance[0];
			$balance = $points_balance->balance + $package->codes_value;
			if ($points_balance->update(['balance'=>$balance])) {
				$description = 'Wykorzystanie kodu '.$this->params['code'].' w akcji '.$promotion_action->name;
				History::addHistoryRecord($client->id, $balance, $package->codes_value, $description, 'add');
			}

		} else {
			$points_balance = new PointsBalance(['client_id'=>$client->id, 'promotor_id'=>$promotor->id, 'balance'=>$package->codes_value]);
			if ($points_balance->save()) {
				$description = 'Wykorzystanie kodu '.$this->params['code'].' w akcji '.$promotion_action->name;
				History::addHistoryRecord($client->id, $package->codes_value, $package->codes_value, $description, 'add');
			}
		} 

		$router = Config::get('router');
		$path = $router->generate('confirmation', ['code'=>$this->params['code']]);
		header('Location: '.$path);
	}

	public function confirmation()
	{
		(new View($this->params, [], 'start'))->render();
	}
	
	private function getOrCreateClient()
	{
		$client = Client::findBy('email', $this->params['client']['email']);

		if (!$client) {
			$client = new Client($this->params['client']);
			$client->save();
			return $client;
		} else {
			return $client;
		}
	}
}