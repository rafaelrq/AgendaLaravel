<?php

namespace IpeAgenda\Http\Controllers;

use Illuminate\Http\Request;
use IpeAgenda\Http\Controllers\Controller;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use IpeAgenda\Agenda;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tbody = '')
    {
        //
        $agendas = Agenda::all();
        if($tbody)
            return view('agenda.tobdy', ['agendas' => $agendas]);
        else
            return view('agenda.index', ['agendas' => $agendas]);
    }

    public function add(Request $request) {
        $rules = array (
                'name' => 'required',
                'phone' => 'required'
        );

        $validator = Validator::make ( Input::all (), $rules );

        if ($validator->fails ())
            return Response::json (array (
                'errors' => $validator->getMessageBag ()->toArray () 
            ) );
        else {
            $data = new Agenda ();
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->save ();

            return $this->index(1);
        }
    }

    public function edit(Request $req) {
        $rules = array (
                'name' => 'required',
                'phone' => 'required'
        );

        $validator = Validator::make ( Input::all (), $rules );

        if ($validator->fails ())
            return Response::json (array (
                'errors' => $validator->getMessageBag ()->toArray () 
            ) );
        else{
            $data = Agenda::find ( $req->id );
            $data->name = $req->name;
            $data->phone = $req->phone;
            $data->email = $req->email;
            $data->save ();

            return $this->index(1);  
        }        
    }

    public function delete(Request $req) {
        Agenda::find ( $req->id )->delete();
        return $this->index(1);
    }

    public function search(Request $req) {
        $rules = array (
                'val_sarch' => 'required'
        );

        $validator = Validator::make ( Input::all (), $rules );

        if ($validator->fails ())
            return Response::json (array (
                'errors' => $validator->getMessageBag ()->toArray () 
            ) );
        else{
            $agendas = Agenda::where('name', 'LIKE', '%'. $req->val_sarch .'%')->get();
            
            return view('agenda.tobdy', ['agendas' => $agendas]);
        }
    }
        
}
