<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Checklist;
use App\Models\ItemChecklist;
use App\Http\Controllers\Api\RegisterController;


class ChecklistController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request -> all();

        $validator = Validator::make($input, [
            'name' => 'required|unique:checklists',
            'user_id' => 'required'            
        ]);

        if($validator -> fails()){
            return sendError('Validation Error.', $validator -> errors());       
        }

        $inputForChecklist['name'] = $input['name'];
        $inputForChecklist['user_id'] = $input['user_id'];

        $checklist = Checklist::create($inputForChecklist);
        
        $response[] = $checklist -> toArray();

        return sendResponse($response, 'Checklist created successfully.');
    }

    public function createItemChecklist(Request $request)
    {
        $input = $request -> all();

        $validator = Validator::make($input, [
            'checklists_id' => 'required',
            'description' => 'required'            
        ]);

        if($validator -> fails()){
            return sendError('Validation Error.', $validator -> errors());       
        }
        
        $input['implementation'] = 0;

        $itemChecklist = ItemChecklist::create($input);

        $response[$itemChecklist -> id] = $itemChecklist -> toArray();

        return sendResponse($response, 'Item for checklist created successfully.');
    }
}