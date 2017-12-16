<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApplicationCollection;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.index');
    }
}
