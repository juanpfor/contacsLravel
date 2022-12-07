<?php

namespace App\Http\Controllers;

use App\Models\Persons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $person = Persons::get();

        return $person;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|unique:persons,email',
            'identificaion' => 'required|unique:persons,identificaion',
            'description' => 'required',
            'surname' => 'required',
            'name' => 'required',
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        }
        $person = new Persons();

        $person->name = $request->name;
        $person->surname = $request->surname;
        $person->email  = $request->email;
        $person->description = $request->description;
        $person->identificaion = $request->identificaion;
        $person->remember_token = $request->remember_token;

        $person->save();

        return [
            "message" => "usuario creado con exito",
            "code" => "200",
            "status" => "success",
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persons  $persons
     * @return \Illuminate\Http\Response
     */
    public function show(Persons $persons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persons  $persons
     * @return \Illuminate\Http\Response
     */
    public function edit($persons)
    {
        $personByID = Persons::where('id', $persons)->get();

        if (count($personByID) == 0) {
            return [
                'results' => [] ,
                "message" => "no se encontro este el usuario con el id $persons",
                "code" => "204",
                "status" => "success",
            ];
        }

        return [
            'results' => $personByID ,
            "message" => "",
            "code" => "200",
            "status" => "success",
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persons  $persons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persons $persons)
    {
        // return $request->id ;
        $persons::findOrFail($request->id);

        $persons->name = $request->name;
        $persons->surname = $request->surname;
        $persons->email  = $request->email;
        $persons->description = $request->description;
        $persons->identificaion = $request->identificaion;
        $persons->remember_token = $request->remember_token;
        $persons->update();

        return response()->json([
            'menssage' => 'success',
            'info'=>'se actualizo su informacion',
            'producto'=>$persons,

        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persons  $persons
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persons $persons)
    {
        //
    }
}
