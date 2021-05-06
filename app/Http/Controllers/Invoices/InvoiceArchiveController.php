<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceArchiveController extends Controller
{
    public function index()
    {
        $invoices=Invoice::onlyTrashed()->get();
        return view('Invoices.Archive.index',compact('invoices'));
    }

    public function ReturnFromArchive(Request $request)
    {
        $invoice = Invoice::withTrashed()->where('id',$request->id);
        $invoice->restore();
        session()->flash('add', 'تم الغاء الارشفه بنجاح');
        return redirect()->route('invoices.index');
    }

    public function DeleteFromArchive(Request $request)
    {
        $invoices = Invoice::withTrashed()->where('id',$request->id)->first();
        $invoices->forceDelete();
        session()->flash('delete', 'تم الحذف بنجاح');
        return redirect()->route('Archive.index');
    }
}
