<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Note as NoteResource;
use App\Http\Controllers\API\BaseController as BaseController;



class NoteController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $notes =Note::where('user_id', auth()->user()->id)->get();
        return view('notes.index', compact('notes'));

    }


    public function create()
    {
        return view('notes.create');
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
        return redirect()->back();

    }


    public function show($id)
    {
        $errorMessage = [];
        $note = Note::find($id);
        if ($note->user_id != Auth::id()) {
            return $this->sendError('you dont have right', $errorMessage);
        }
       return view('notes.show', compact('note'));
    }



    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $input = $request->all();
        $validator = Validator::make($input , [
            'date'=> 'required',
            'hour'=> 'required',
            'title'=> 'required',
            'note'=> 'required'
        ]);

        if( $note->user_id != Auth::id()) {
            return $this->sendError('Note not found');
        }
        $note->date = $input['date'];
        $note->hour = $input['hour'];
        $note->title = $input['title'];
        $note->note = $input['note'];
        $note->save();

        return redirect()->back();
    }



    public function destroy(Note $note)
    {
        $errorMessage = [];
        if( $note->user_id != Auth::id()) {
            return $this->sendError('Note not found', $errorMessage);
        }
        $note->delete();
        return redirect()->back();
    }
}
