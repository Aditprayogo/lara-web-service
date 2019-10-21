<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Resources\Categories as CategoryResourceCollection;

use App\Http\Resources\Category as CategoryResource;


class CategoryController extends Controller
{
    //
    public function random($count)
    {
        # code...
        $criteria = Category::select('*')
                    ->inRandomOrder()
                    ->limit($count)
                    ->get();
        return new CategoryResourceCollection($criteria);
    }

    public function index()
    {
        # code...
        $criteria = Category::paginate(6);
        return new CategoryResourceCollection($criteria);
	}
	
	public function slug($slug)
	{
		# code...
		$criteria = Category::where('slug', $slug)->first();
		return new CategoryResource($criteria);
	}
}
