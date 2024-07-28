<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class InstructorParticipants extends Component
{
    public $participants;


    public function deleteParticipants($id){
        try{
            User::where('id', $id)->first()->delete();
            $this->fetchParticipants();
        }catch(Exception $e){

        }
    }

    public function fetchParticipants(){
        $this->participants = User::where('group_no', Auth::user()->group_no)
        ->orderBy("user_type","ASC")->get();
    }
    public function mount(){
        $this->fetchParticipants();
    }


    public function render()
    {
        return view('livewire.instructor.instructor-participants');
    }
}
