<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminController;
use App\User;
use App\Division;
use Excel,Input,File;
use Illuminate\Support\Facades\DB;
class ExcelController extends AdminController
{
    /*
    * export to excel all user
    */

    public function exportExcelAllUser()
    {
    	$export =  DB::table('users')->leftJoin('divisions','users.devision_id','=','divisions.id')->select('users.id','users.name','users.email','divisions.name as divison_name')->get();
    	$export = $export->map(function ($item){
            return get_object_vars($item);
        });
    	Excel::create('export data', function($excel) use($export){
    		$excel->sheet('Sheet 1', function($sheet) use($export){
    			$sheet->fromArray($export);
    		});
    	})->export('xlsx');
    }

    /**
    * export to excel user in division
    */

    public function exportExcelUserInDivision($id)
    {
        $export = DB::table('users')->join('divisions','users.devision_id','=','divisions.id')->select('users.id','users.name','users.email')->get();
        $export = $export->map(function ($item){
            return get_object_vars($item);
        });
        Excel::create('export data', function($excel) use($export){
            $excel->sheet('Sheet 1', function($sheet) use($export){
                $sheet->fromArray($export);
            });
        })->export('xlsx');
    }
}
