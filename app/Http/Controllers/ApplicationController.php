<?php

namespace App\Http\Controllers;

use App\ApplicationStatus;
use App\ApplicationType;
use App\Application;
use App\Http\Requests\CreateApplicationFormRequest;
use App\Http\Resources\ApplicationTypeCollection;
use App\Mail\ApplicationCreated;
use App\Mail\ApplicationLecturerApproved;
use App\Mail\ApplicationUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portal.application.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param CreateApplicationFormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateApplicationFormRequest $request)
    {
        return response()
            ->json([ 'data' => 'okay'], 200);
    }
}
