<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Province;
use App\Http\Resources\Provinces as ProvinceResourceCollection;
use App\City;
use App\Http\Resources\Cities as CityResourceCollection;

class ShopController extends Controller
{
    public function provinces()
	{
		# code...
		return new ProvinceResourceCollection(Province::get());
	}

	public function cities()
	{
		# code...
		return new CityResourceCollection(City::get());
	}

	public function shipping(Request $request)
	{
		# code...
		$user = Auth::user();
		$status = "error";
		$message = "";
		$data = null;
		$code = 200;

		// jika usernya ada
		if ($user) {
			# code...
			// validate daata user
			$this->validate($request,[
				'name' => 'required',
				'address' => 'required',
				'phone' => 'required',
				'province_id' => 'required',
				'city_id' => 'required',
			]);

			$user->name =  $request->name;
			$user->address = $request->address;
			$user->phone = $request->phone;
			$user->province_id = $request->province_id;
			$user->city_id = $request->city_id;

			if ($user->save()) {
				# code...
				$status = "success";
				$message = "Update shipping success";
				$data = $user->toArray(); 

			} else {

				$message = "Update shipping failed";

			}

		} else {

			$message = "User not found";

		}

		return response()->json([
			'status' => $status,
			'message' => $message,
			'data' => $data
		], $code);

		
	}

	public function couriers()
	{
		# code...
		$couriers = [
			['id'=>'jne', 'text'=> 'JNE'],
			['id'=>'tiki', 'text'=> 'TIKI'],
			['id'=>'pos', 'text'=> 'POS'],
		];

		return response()->json([
			'status' => 'success',
			'message' => 'couriers',
			'data' => $couriers
		], 200);
		   
	}
}
