<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;

class DriversController extends Controller
{
    public function index(){
        $drivers = Driver::all();
        return view('layouts.drivers.index')->with(compact('drivers'));
    }

    public function create(){
        return view('layouts.drivers.create');
    }

    public function store(request $request){
        dd($request->all());
    }
}
