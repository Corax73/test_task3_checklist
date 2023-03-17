<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
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
            'checklist_id' => 'required',
            'description' => [
                'required',
                Rule::unique('item_checklists') -> where(fn (Builder $query) => $query -> where('checklist_id', $input['checklist_id']))
                ]           
        ]);

        if($validator -> fails()){
            return sendError('Validation Error.', $validator -> errors());       
        }

        $input['implementation'] = 0;

        $itemChecklist = ItemChecklist::create($input);

        $response[$itemChecklist -> id] = $itemChecklist -> toArray();

        return sendResponse($response, 'Item for checklist created successfully.');
    }

    public function getUsersChecklists($user_id)
    {
        //$user = User::findOrFail(Auth::id());
        $user = User::findOrFail($user_id);
        $response[] = $user -> checklists -> toArray();

        return sendResponse($response, 'Checklist ' . $user['name']);
    }

    public function getItemsChecklists($checklist_id)
    {
        $checklists = Checklist::findOrFail($checklist_id);
        $response[] = $checklists -> items -> toArray();

        return sendResponse($response, 'Item\'s of ' . $checklists['name']);
    }

    public function setItemsImplementation(Request $request, $checklist_id, $item_description, $implementation)
    {
        
        $input['implementation'] = $implementation;

        $validator = Validator::make($input, [
            'implementation' => 'required|integer|gte:0|lte:1'          
        ]);

        if($validator -> fails()){
            return sendError('Validation Error.', $validator -> errors());       
        }

        $idItemChecklist = ItemChecklist::where('checklist_id', $checklist_id) -> where('description', $item_description) -> firstOrFail();

        $itemChecklist = ItemChecklist::where('checklist_id', $checklist_id) -> where('description', $item_description) -> update(['implementation' => $implementation]);
        
        $itemChecklist = ItemChecklist::findOrFail($idItemChecklist -> id);

        $response[] = $itemChecklist -> toArray();
        
        return sendResponse($response, 'Implementation\'s of ' . $itemChecklist['description'] . 'set ' . ($implementation == true ? 'true' : 'false'));
    }
}
