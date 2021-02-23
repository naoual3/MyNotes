<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\Note as NoteResource;
use App\Http\Controllers\API\BaseController as BaseController;


class NoteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $notes = Note::where('user_id', $id)->get();

        return $this->sendResponse(NoteResource::collection($notes), ' Notes sent successfully');


    }



    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input , [
            'date'=> 'required',
            'hour'=> 'required',
            'title'=> 'required',
            'note'=> 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Please validate error' , $validator->errors());
        }
        $user =Auth::user();
        $input['user_id'] = $user->id;
        $note = Note::create($input);
        return $this->sendResponse($note , 'Note created successfully');
    }


    public function show($id)
    {
        $errorMessage = [];

        $note = Note::find($id);
        if( $note->user_id != Auth::id()) {
            return $this->sendError('you dont have right', $errorMessage);
        }
        return $this->sendResponse(new NoteResource($note) , 'Note found successfully');

    }



    public function update(Request $request, Note $note)
    {
        $input = $request->all();
        $validator = Validator::make($input , [
            'date'=> 'required',
            'hour'=> 'required',
            'title'=> 'required',
            'note'=> 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }

        if( $note->user_id != Auth::id()) {
            return $this->sendError('Note not found', $validator->errors());
        }
        $note->date = $input['date'];
        $note->hour = $input['hour'];
        $note->title = $input['title'];
        $note->note = $input['note'];
        $note->save();

        return $this->sendResponse(new NoteResource($note) , 'Note updeted successfully');
    }


    public function destroy(Note $note)
    {
        $errorMessage = [];

        if( $note->user_id != Auth::id()) {
            return $this->sendError('Note not found', $errorMessage);
        }
        $note->delete();
        return $this->sendResponse(new NoteResource($note) , 'Note deleted successfully');


    }
}

