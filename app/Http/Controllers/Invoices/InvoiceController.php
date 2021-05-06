<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Invoice_attachment;
use App\Models\Invoice_detail;
use App\Models\Section;
use Auth;
use DB;
use Illuminate\Http\Request;
use Storage;

class InvoiceController extends Controller
{

    public function index()
    {

        $invoices = Invoice::all();
        return view('Invoices.index', compact('invoices'));
    }


    public function create()
    {
        $sections = Section::all();
        return view('Invoices.create', compact('sections'));
    }


    public function store(Request $request)
    {

        Invoice::create([
            'invoice_number'    => $request->invoice_number,
            'invoice_Date'      => $request->invoice_Date,
            'Due_date'          => $request->Due_date,
            'product'           => $request->product,
            'section_id'        => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount'          => $request->Discount,
            'Value_VAT'         => $request->Value_VAT,
            'Rate_VAT'          => $request->Rate_VAT,
            'Total'             => $request->Total,
            'Status'            => 'غير مدفوعة',
            'Value_Status'      => 2,
            'note'              => $request->note,
        ]);

        $invoice_id = Invoice::latest()->first()->id;

        Invoice_detail::create([
            'id_Invoice'        => $invoice_id,
            'invoice_number'    => $request->invoice_number,
            'product'           => $request->product,
            'Section'           => $request->Section,
            'status'            => 'غير مدفوعة',
            'value_status'      => 2,
            'note'              => $request->note,
            'user'              => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id         = Invoice::latest()->first()->id;
            $invoice_number     = $request->invoice_number;
            $image              = $request->file('pic');
            $file_name          =$image->getClientOriginalName();


            Invoice_attachment::create([
            'file_name'         => $file_name,
            'invoice_number'    => $invoice_number,
            'Created_by'        => Auth::user()->name,
            'invoice_id'        => $invoice_id,
            ]);

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return redirect()->route('invoices.index');

    }


    public function edit($id)
    {
        $data = [];
        $data['invoices'] = Invoice::where('id', $id)->first();
        $data['sections'] = Section::all();
        return view('Invoices.edit_invoices', $data);

    }

    public function update(Request $request)
    {

        $invoices = Invoice::findOrFail($request->invoice_id);
        $invoices->update([
            'invoice_number'    => $request->invoice_number,
            'invoice_Date'      => $request->invoice_Date,
            'Due_date'          => $request->Due_date,
            'product'           => $request->product,
            'section_id'        => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount'          => $request->Discount,
            'Value_VAT'         => $request->Value_VAT,
            'Rate_VAT'          => $request->Rate_VAT,
            'Total'             => $request->Total,
            'note'              => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return redirect()->route('invoices.index');
    }


    public function destroy(Request $request)
    {

        $invoices   = Invoice::where('id', $request->id)->first();
        $Attachment = Invoice_attachment::where('invoice_id', $request->id)->first();
        $Details    = Invoice_detail::where('id_Invoice', $request->id)->first();
        $id_page=$request->id_page;
        if (!$id_page==2) {

            if (!empty($Attachment->invoice_number)) {

                Storage::disk('public_uploads')->deleteDirectory($Attachment->invoice_number);
            }

            $invoices->forceDelete();
            $Attachment->forceDelete();
            $Details->forceDelete();
            session()->flash('delete', 'تم حذف الفتوره بنجاح');
            return redirect()->route('invoices.index');
        }
        else{

            $invoices->delete();

            session()->flash('add', 'تم ارشفه الفتوره بنجاح');
            return redirect()->route('Archive.index');
        }


    }

    //Get products by AJAX
    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }


    //Get Form Update Status Payment
    public function show($id)
    {
        $invoices = Invoice::where('id', $id)->first();

        return view('Invoices.Status-Payment.Update-status', compact('invoices'));
    }

    //Update Status Payment
    public function Status_Update(Request $request, $id)
    {
        $invoices = Invoice::findOrFail($id);

        if ($request->Status === 'مدفوعة') {

            $invoices->update([
                'Value_Status'  => 1,
                'Status'        => $request->Status,
                'Payment_Date'  => $request->Payment_Date,
            ]);

            Invoice_detail::create([
                'id_Invoice'     => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product'        => $request->product,
                'Section'        => $request->Section,
                'status'         => $request->Status,
                'value_status'   => 1,
                'note'           => $request->note,
                'Payment_Date'   => $request->Payment_Date,
                'user'           => (Auth::user()->name),
            ]);
        } else {
            $invoices->update([
                'Value_Status'  => 3,
                'Status'        => $request->Status,
                'Payment_Date'  => $request->Payment_Date,
            ]);
            Invoice_detail::create([
                'id_Invoice'     => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product'        => $request->product,
                'Section'        => $request->Section,
                'status'         => $request->Status,
                'value_status'   => 3,
                'note'           => $request->note,
                'Payment_Date'   => $request->Payment_Date,
                'user'           => (Auth::user()->name),
            ]);
        }
        session()->flash('Status_Update');
        return redirect('/invoices');
    }

    public function Invoice_Paid()
    {
        $invoices=Invoice::where('Value_Status',1)->get();

        return view('Invoices.Paid-invoices.index',compact('invoices'));

    }

    public function Invoice_UnPaid()
    {
        $invoices=Invoice::where('Value_Status',2)->get();

        return view('Invoices.Unpaid-Invoices.index',compact('invoices'));
    }

    public function Invoice_Partial()
    {
        $invoices=Invoice::where('Value_Status',3)->get();

        return view('Invoices.Prat-paid-Invoices.index',compact('invoices'));
    }

}
