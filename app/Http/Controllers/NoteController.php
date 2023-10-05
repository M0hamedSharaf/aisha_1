<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notes\storeNoteRequest;
use App\Models\Note;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Services\Note\NoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class NoteController extends Controller
{
    public $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function studentIndex()
    {
        $students = Student::students()->select(['id','name'])->get();
        $notes = [];

        $authenticatedUser = Auth::guard(getGuard())->user();

        if(getGuard() == "admin")
        {
            $notes = Note::orderBy('id','desc')->with('noteby')->get();
        }
        else if(getGuard() == 'teacher')
        {
            $notes = Note::orderBy('id','desc')
                ->where('noteby_type', Teacher::class)
                ->where('noteby_id', $authenticatedUser->id)
                ->where('notable_type', Student::class)
                ->with('noteby')
                ->get();
        }
        else if(getGuard() == 'student')
        {
            $notes = Note::orderBy('id','desc')
                ->where('notable_type', Student::class)
                ->where('notable_id', $authenticatedUser->id)
                ->with('noteby')
                ->get();
        }


        foreach($notes as $note)
        {
            $type = explode("\\", $note->noteby_type);
            $type = end($type);

           
            if($type == "User")
            {
                $type = "Admin";
            }

            $note->byText = $type . " " . $note->noteby->name;
        }

        return view('pages.student.note', [
            'students' => $students,
            'notes' => $notes
        ]);
    }

    public function studentStore(storeNoteRequest $request)
    {
        if(getGuard() == 'admin')
        {
            Note::create([
                'notable_type' => Student::class,
                'notable_id' => $request->student_id,
                'noteby_type' => User::class,
                'noteby_id' => $request->noteby_id,
                'title' => $request->title,
                'note' => $request->note,
            ]);
        }
        else if(getGuard() == 'teacher')
        {
            Note::create([
                'notable_type' => Student::class,
                'notable_id' => $request->student_id,
                'noteby_type' => Teacher::class,
                'noteby_id' => $request->noteby_id,
                'title' => $request->title,
                'note' => $request->note,
            ]);
        }
        else if(getGuard() == 'student')
        {
            Note::create([
                'notable_type' => Student::class,
                'notable_id' => $request->student_id,
                'noteby_type' => Student::class,
                'noteby_id' => $request->noteby_id,
                'title' => $request->title,
                'note' => $request->note,
            ]);
        }

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function delete(Note $note)
    {
        $note->delete();
        
        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }


    public function toggleFavorite(Note $note)
    {
        $note->update([
            'is_favorite' => ! $note->is_favorite
        ]);

       return response()->json([
            'status' => 200,
            'new_is_favorite' => $note->is_favorite
        ]);
    }


    public function updateNoteType(Request $request, Note $note)
    {
        $type = explode('-',$request->type);

        $note->update([
            'type' => $request->type ? end($type) : null
        ]);

       return response()->json([
            'status' => 200,
        ]);
    }
}
