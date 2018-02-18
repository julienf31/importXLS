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

        //premiére lecture de la feuille
        $reader = new PhpOffice\PhpSpreadsheet\Reader\Xls();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load("15_UG_09Feb2018111910002.xls");

        // on determine la ligne maximale pour virer le commentaire de fin et l'entete
        $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
        $firstRow = 5;
        $lastRow = $highestRow-2;


        // Lecture de la feuille avec uniquement les valeures du tableau
        $filterSubset = new ReadFilter($firstRow,$lastRow);
        $reader->setReadFilter($filterSubset);
        $spreadsheet2 = $reader->load("15_UG_09Feb2018111910002.xls");
        $sheetData = $spreadsheet2->getActiveSheet()->toArray(null, true, true, true);

        //création du tableau de titres
        $titles = array_slice($sheetData,4,1);
        $title = array();
        foreach ($titles[0] as $tit){
            array_push($title,str_replace(' ','_',str_replace('  ',' ',str_replace('-','',strtolower($tit)))));
        }

        //création du tableau de donnée
        $data = array_slice($sheetData,5);

        $import = array();
        foreach ($data as $dat){
            $i = 0;
            $insert = array();
            foreach ($dat as $cell){
                $insert[$title[$i]] = $cell;
                $i++;
            }
            array_push($import,$insert);
        }

        //insertion du tableau
        Data::insert($import);

        return Redirect::route('home');
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