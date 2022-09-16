<?php

namespace App\Http\Controllers;

use App\Models\CashBox;
use Illuminate\Http\Request;

class CashBoxController extends Controller
{
  //comentario cashbox
    function getAllCashBox ()  {
      $allCategory = CashBox::get();
      return $allCategory;
    }
}
