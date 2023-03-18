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
            'user_id' => 'required|integer'            
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
            'checklist_id' => 'required|integer',
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
        $input['user_id'] = $user_id;
        
        $validator = Validator::make($input, [
            'user_id' => 'required|integer'           
        ]);

        if($validator -> fails()){

            return sendError('Validation Error.', $validator -> errors());
        
        }

        if ($user = User::find($user_id)) {

            $response[] = $user -> checklists -> toArray();
            return sendResponse($response, 'Checklist ' . $user['name']);

        } else {

            return 'User not found';
        }
    }

    public function getItemsChecklists($checklist_id)
    {
        $input['checklist_id'] = $checklist_id;
        
        $validator = Validator::make($input, [
            'checklist_id' => 'required|integer'           
        ]);

        if($validator -> fails()){

            return sendError('Validation Error.', $validator -> errors());

        }

        if ($checklists = Checklist::find($checklist_id)) {

            $response[] = $checklists -> items -> toArray();
            return sendResponse($response, 'Item\'s of ' . $checklists['name']);
            
        } else {

            return 'Checklist not found';

        }
    }

    public function setItemsImplementation($checklist_id, $item_description, $implementation)
    {
        
        $input['checklist_id'] = $checklist_id;
        $input['description'] = $item_description;
        $input['implementation'] = $implementation;

        $validator = Validator::make($input, [
            'checklist_id' => 'required|integer',
            'description' => 'required',
            'implementation' => 'required|integer|gte:0|lte:1'          
        ]);

        if($validator -> fails()){

            return sendError('Validation Error.', $validator -> errors());

        }

        if ($idItemChecklist = ItemChecklist::where('checklist_id', $input['checklist_id']) -> where('description', $input['description']) -> first()) {

            $itemChecklist = ItemChecklist::where('checklist_id', $input['checklist_id']) -> where('description', $input['description']) -> update(['implementation' => $input['implementation']]);
            $itemChecklist = ItemChecklist::find($idItemChecklist -> id);
            $response[] = $itemChecklist -> toArray();
            return sendResponse($response, 'Implementation\'s of ' . $itemChecklist['description'] . 'set ' . ($input['implementation'] == true ? 'true' : 'false'));

        } else {

            return 'ItemChecklist not found';

        }
    }

    public function destroyUsersChecklists($checklist_id)
    {
        $input['checklist_id'] = $checklist_id;
        
        $validator = Validator::make($input, [
            'checklist_id' => 'required|integer'           
        ]);

        if($validator -> fails()){

            return sendError('Validation Error.', $validator -> errors());
        
        }

        if ($checklist = Checklist::find($input['checklist_id'])) {
            
            $checklist -> delete();
            $response['Checklist'] = 'removed';
            return sendResponse($response, 'Checklist removed');

        } else {

            return 'Checklist not found';

        }
    }

    public function destroyItemsChecklists($checklist_id, $item_description)
    {
        $input['checklist_id'] = $checklist_id;
        $input['description'] = $item_description;
        
        $validator = Validator::make($input, [
            'checklist_id' => 'required|integer',
            'description' => 'required'          
        ]);

        if($validator -> fails()){

            return sendError('Validation Error.', $validator -> errors());

        }

        if ($itemChecklist = ItemChecklist::where('checklist_id', $input['checklist_id']) -> where('description', $input['description']) -> first()) {

            $itemChecklist -> delete();
            $response['ItemChecklist'] = 'removed';
            return sendResponse($response, 'ItemChecklist removed');

        } else {

            return 'ItemChecklist not found';

        }
    }
}
