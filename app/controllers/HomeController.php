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
        //$excel = App::make('Excel');
        $excel->load('15_UG_09Feb2018111910002.xls', function($reader){
            // Loop through all rows
            $sheet = $reader->getSheet(0);
            echo "sheet : ";
            print_r($sheet);
            die();
            //$highestRow = $sheet->getHighestRow();
            //echo $reader->getHighestRow();
            $reader->each(function($row) {
                //echo "<br>$row<br>";
                if(str_contains($row,"OFF")){
                    echo "stop";
                }
            });
        });


        die();
        $collection = array();
        foreach ($dump as $line){
            array_push($collection, $line);
        }

        Data::insert($collection);

        return Redirect::route('home');
    }

    public function truncateFile(){
        Excel::load('15_UG_09Feb2018111910002.xls', function($reader) {

        })->get();
    }

    public function clean(){
        Data::truncate();
        return Redirect::route('home');
    }


}