<?php

namespace App\Helpers;

use App\Models\Requisitions\Requisition;
use Carbon\Carbon;
use \Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PrintHelper
{

	static public function getFilename($name = NULL)
	{
		set_time_limit(3600);
		return (($name != NULL) ? $name .'_' : $name ). 'print_' . Carbon::now()->format('d_m_Y-H_i').'.pdf';
	}
    // ******************** FUNCTIONS ******************************

    static public function requisitionExport(Requisition $requisition, $page)
    {
    	$user = Auth::user();
        $filename = self::getFilename('requisicao_' . $requisition->id);
	    $options = [
	    	'filename' => $filename,
		    'Requisition' => $requisition,
		    'User' => $user,
		    'Data' => DataHelper::now(),
	    ];
//	    return view('prints.requisitions', $options);
	    $pdf = PDF::loadView('prints.requisitions.' . $page, $options);
        $pdf->getDomPDF()->set_option("enable_php", true);
        return $pdf->stream($filename );
    }

    static public function requisitionPrint(Requisition $requisition, $page)
    {
    	$user = Auth::user();
	    $filename = self::getFilename('requisicao_' . $requisition->id);
	    $options = [
	    	'filename' => $filename,
		    'Requisition' => $requisition,
		    'User' => $user,
		    'Data' => DataHelper::now(),
	    ];
//	    return $options;
//	    return view('prints.requisitions.' . $page, $options);
	    $pdf = PDF::loadView('prints.requisitions.' . $page, $options);
        $pdf->getDomPDF()->set_option("enable_php", true);
        return $pdf->stream($filename );
    }

    static public function requisitions(Collection $collection, $all = false)
    {
    	$user = Auth::user();
        $filename = self::getFilename('requisicoes');
	    $options = [
		    'all' => $all,
	    	'filename' => $filename,
		    'Requisitions' => $collection,
		    'User' => $user,
		    'Data' => DataHelper::now(),
		    'Total' => DataHelper::getFloat2Currency($collection->sum('total')),
	    ];
//	    return view('prints.requisitions', $options);
	    $pdf = PDF::loadView('prints.requisitions.report', $options);
        $pdf->getDomPDF()->set_option("enable_php", true);
        return $pdf->stream($filename );
    }


    static public function products(Collection $collection, $all = false)
    {
    	$user = Auth::user();
        $filename = self::getFilename('produtos');
	    $options = [
		    'all' => $all,
		    'filename' => $filename,
		    'Products' => $collection,
		    'User' => $user,
		    'Data' => DataHelper::now(),
	    ];
	    if($all){
		    return view('prints.products', $options);
	    }
	    $pdf = PDF::loadView('prints.products', $options);
        $pdf->getDomPDF()->set_option("enable_php", true);
        return $pdf->stream($filename );
    }


}
