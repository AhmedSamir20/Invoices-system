<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Invoice_attachment;
use App\Models\Invoice_detail;
use Illuminate\Http\Request;
use Storage;

class InvoicesDetailsController extends Controller
{

    public function edit($id)

    {
        $data=[];
        $data['invoices'] = Invoice::where('id',$id)->first();
        $data['details'] = Invoice_detail::where('id_Invoice',$id)->get();
        $data['attachments']  = Invoice_attachment::where('invoice_id',$id)->get();
        return view('Invoices.details_invoice',$data);
    }


    public function open_file($invoice_number,$file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);
    }

    public function get_file($invoice_number,$file_name)
    {
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download( $contents);
    }


    public function destroy(Request $request)
    {
        $invoices = Invoice_attachment::findOrFail($request->id);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete');
        return back();
    }


}
