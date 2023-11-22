<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\NewLeadEmail;
use App\Mail\NewLeadEmailMd;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{



    function store(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);


        // redirect if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // altimenti keep going 👇


        // save the new lead in the db
        $lead = Lead::create($request->all());

        // send email to my self
        Mail::to('info@boolpress.com')->send(new NewLeadEmail($lead));
        // TODO: send a confirmation email to the user
        Mail::to($lead->email)->send(new NewLeadEmailMd($lead));

        // return a json success response


        return response()->json(
            [
                'success' => true,
                'message' => 'Form sent successfully 👍'
            ]
        );
    }
}
