<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Models\Top;
 
class TopController extends Controller
{
    /**
        * タスク一覧
        *
        * @param Request $request
        * @return Response
        */
    public function index(Request $request)
    {
        $tops = Top::orderBy('created_at', 'asc')->get();
        return view('tops.index', [
            'tops' => $tops,
        ]);
    }
}