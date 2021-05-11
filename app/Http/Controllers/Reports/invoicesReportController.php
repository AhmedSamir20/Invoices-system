<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class invoicesReportController extends Controller
{
    public function index()
    {
        return view('Reports.InvoicesReport');
    }

    public function searchInvoices(Request $request)
    {
        $rdio = $request->rdio;

        // if search type of invoices
        if ($rdio == 1) {


            //if not Specify invoices date
            if ($request->type && $request->start_at == '' && $request->end_at == '') {

                $invoices = Invoice::select('*')->where('Status', '=', $request->type)->get();
                $type = $request->type;
                return view('Reports.InvoicesReport', compact('type'))->withDetails($invoices);
            } //if Specify invoices date
            else {

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('Status', '=', $request->type)->get();
                return view('Reports.InvoicesReport', compact('type', 'start_at', 'end_at'))->withDetails($invoices);

            }


        }

//====================================================================


        // if search with invoices number
        else {

            $invoices = Invoice::select('*')->where('invoice_number', '=', $request->invoice_number)->get();
            return view('Reports.InvoicesReport')->withDetails($invoices);

        }

    }
}
