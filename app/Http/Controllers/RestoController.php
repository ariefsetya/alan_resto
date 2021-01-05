<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use App\TempTransaction;

class RestoController extends Controller
{
	public function index($tab = "")
	{
		$data['food'] = Food::get();
		$data['temp_transaction'] = TempTransaction::get();
		$data['tab'] = $tab;

		return view('layouts.master')->with($data);
	}
	public function add_menu(Request $r)
	{
		$f = new Food;
		$f->name = $r->input('name');
		$f->price = $r->input('price');
		if($r->hasFile('image_url')){
			$path = $r->image_url->store('public/images');
			$f->image_url = $path;
		}
		$f->save();

		return redirect(url('/'));
	}
	public function add_temp($food_id)
	{
		$f = Food::find($food_id);

		$tt = TempTransaction::firstOrNew(['food_id'=>$food_id]);
		$tt->quantity = $tt->quantity+1 ?? 1;
		$tt->price = $f->price;
		$tt->total = $tt->quantity*$f->price;
		$tt->save();

		return redirect(url('/transaksi'));
	}
}
