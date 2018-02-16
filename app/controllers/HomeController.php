<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
	    $data['datas'] = Data::all();
		return View::make('hello', $data);
	}

	public function read(){
        Config::set('excel::import.startRow', 5);

        $excel = App::make('Excel');
        $dump = $excel->load('15_UG_09Feb2018111910002.xls')->ignoreEmpty()->all()->toArray();

        $collection = array();
        foreach ($dump as $line){
            array_push($collection, $line);
        }

        Data::insert($collection);

        return Redirect::route('home');
    }

    public function clean(){
        Data::truncate();
        return Redirect::route('home');
    }

}
