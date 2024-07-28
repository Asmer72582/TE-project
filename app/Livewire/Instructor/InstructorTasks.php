<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\Proposals;
use App\Models\Tasks;
use Exception;
use Illuminate\Support\Facades\Auth;

class InstructorTasks extends Component
{

    public $tasks,$week_no,$task_title,$task_due_date,$group_no;

    public function create_task(){
        $new_task = new Tasks([
            "group_no"=> Auth::user()->group_no,
            "week_no" => $this->week_no,
            "task_title" => $this->task_title,
            "task_due_date" => $this->task_due_date
        ]);
        $new_task->save();
        $this->reset(['week_no','task_title','task_due_date']);
        $this->dispatch("task_created");
        $this->FetchTasks();
    }

    public function deleteTask($task_id){
        try{

            Tasks::where("task_id",$task_id)->first()->delete();
            $this->FetchTasks();

        }catch(Exception $e){
            // dd($e);
        }
    }

    public function update_remark($remark,$task_id,$approved_or_rejected){
        try{
            Tasks::where('task_id', $task_id)->update(['task_remark' => $remark,"task_status"=>!$approved_or_rejected]);
        }catch(Exception $e){}
        $this->FetchTasks();
    }

    public function FetchTasks()
    {
        $this->tasks = Tasks::where("group_no", Auth::user()->group_no)->orderBy("week_no","ASC")->get();
        // dd($this->tasks);
    }

    public function mount()
    {
        $this->group_no = Auth::user()->group_no;
        $this->FetchTasks();
    }

    public function render()
    {
        return view('livewire.instructor.instructor-tasks');
    }
}
