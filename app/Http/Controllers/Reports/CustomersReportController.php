<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;

class CustomersReportController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('Reports.customersReport', compact('sections'));
    }

    public function searchInvoices(Request $request)
    {


        // if search without Date
        if ($request->Section && $request->product && $request->start_at == '' && $request->end_at == '') {


            $invoices = Invoice::select('*')->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
            $sections = Section::all();
            return view('Reports.customersReport', compact('sections'))->withDetails($invoices);


        }
        // if search with Date
        else {

            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
            $sections = Section::all();
            return view('Reports.customersReport', compact('sections'))->withDetails($invoices);


        }


    }
}
