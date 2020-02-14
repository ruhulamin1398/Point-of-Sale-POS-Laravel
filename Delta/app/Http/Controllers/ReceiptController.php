<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Purchase;
class ReceiptController extends Controller
{
  
    

    public function purchaseShow($id)
    {
        
        $purchase= Purchase::find($id);
     
        return  view('receipt.purchaseReceipt', compact('purchase'));
    } 
    

    public function orderShow($id)
    {
        
        $order= Order::find($id);
        return  view('receipt.orderReceipt', compact('order'));
    } 




}
