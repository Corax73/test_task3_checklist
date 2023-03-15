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
            'name' => 'required',
            'user_id' => 'required',
            'description' => 'required'            
        ]);

        if($validator -> fails()){
            return sendError('Validation Error.', $validator -> errors());       
        }

        $inputForChecklist['name'] = $input['name'];
        $inputForChecklist['user_id'] = $input['user_id'];

        $checklist = Checklist::create($inputForChecklist);
        
        $inputForItemChecklist['description'] = $input['description'];
        $inputForItemChecklist['checklists_id'] = $checklist -> id;
        $inputForItemChecklist['implementation'] = 0;

        $itemChecklist = ItemChecklist::create($inputForItemChecklist);

        $response[] = $checklist -> toArray();
        $response[$itemChecklist -> id] = $itemChecklist -> toArray();

        return sendResponse($response, 'Checklist created successfully.');
    }
}
