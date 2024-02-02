<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Sikayet;
use App\Models\Operator;
use DataTables;

class SikayetlerController extends Controller
{

    public function Sikayetler(Request $request) {

        $sikayetData = Sikayet::with(['sikayetcil', 'operator'])->get();

        if($request->ajax()) {

             return  DataTables::of($sikayetData)->make(true);

        }
        $operators = Operator::pluck('ad', 'id');
        $data['header_title'] = 'Şikayətlər';

        return view('pages.sikayetler', compact('data', 'operators'));

    }

    public function Elave (Request $request) {

        //dd($request->all());

        $dataForm = [
            'sikayetci' => auth()->id(),
            'operator_id' => $request->operator_id,
            'movzu' => $request->movzu,
            'metn' => $request->metn,
            'fayllar' => '',
        ];

        Sikayet::create($dataForm);

        $data['message']='Yaradıldı';

        return response()->json($data, 200);

    }

    public function Baxis ($id, Request $request) {
        if($request->ajax()) {
            $sikayet = Sikayet::with(['sikayetcil', 'operator'])->findOrFail($id);
            return response()->json($sikayet);
        }
    }

}
