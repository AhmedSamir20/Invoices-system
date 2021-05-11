<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoice_attachment;
use Auth;
use Illuminate\Http\Request;

class InvoiceAttachmentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [

            'file_name' => 'mimes:pdf,jpeg,png,jpg',
        ], [
            'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
        ]);

        $image = $request->file('file_name');
        $file_name = $image->getClientOriginalName();

        Invoice_attachment::create([
            'file_name' => $file_name,
            'invoice_number' => $request->invoice_number,
            'invoice_id' => $request->invoice_id,
            'Created_by' => Auth::user()->name,
        ]);

        // move pic
        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/'. $request->invoice_number), $imageName);

        session()->flash('add_attachment');
        return back();

    }
}
