<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function pdfgenerate(){
        
    $data = Transaction::all();
    $pdf = Pdf::loadView('invoice', compact('data'));
    return $pdf->stream('billing-invoice');
    }

    public function downoadpdf($id){
        $data = Transaction::find($id);
        $detailtransaction = TransactionDetail::where('transactions_id',$id)->get();
        $pdf = Pdf::loadView('invoice', compact('data','detailtransaction'));
        return $pdf->download('billing-invoice.pdf');
    }
}
