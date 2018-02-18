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


        $reader = new PhpOffice\PhpSpreadsheet\Reader\Xls();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load("15_UG_09Feb2018111910002.xls");

        $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
        $firstRow = 5;
        $lastRow = $highestRow-2;


        $filterSubset = new ReadFilter(5,$lastRow);
        $reader->setReadFilter($filterSubset);
        $spreadsheet2 = $reader->load("15_UG_09Feb2018111910002.xls");

        $sheetData = $spreadsheet2->getActiveSheet()->toArray(null, true, true, true);

        $data = array_slice($sheetData,4);

        foreach ($data as $dat){
            foreach ($dat as $cell){
                echo $cell;
            }
            echo "<hr>";
        }


        die();
        //Data::insert();

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

class ReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    private $startRow = 0;
    private $endRow   = 0;

    public function __construct($startRow, $endRow) {
        $this->startRow = $startRow;
        $this->endRow   = $endRow;
    }

    public function readCell($column, $row, $worksheetName = '') {
        if ($row >= $this->startRow && $row <= $this->endRow) {
            return true;
        }
        return false;
    }
}