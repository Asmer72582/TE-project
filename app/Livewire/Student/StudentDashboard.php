<?php

namespace App\Livewire\Student;

use App\Models\Notifications;
use App\Models\Proposals;
use App\Models\Repositories;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentDashboard extends Component
{

    public $participants_count = 0;
    public $notification_count = 0;

    public $repositories_count = 0;

    public $tasks_count = 0;

    public $stu_task_remaining, $stu_per_done;
    public $approved_task_remaining, $approved_per_done;

    public $accepted_proposal;

    public function fetchProgress()
    {
        // For Student Progress
        $studentTotalTasks = Tasks::where('group_no', Auth::user()->group_no)->count();
        $studentCompletedTasks = Tasks::where('group_no', Auth::user()->group_no)
            ->whereNotNull('task_completed_date')
            ->count();
        $studentPendingTasks = Tasks::where('group_no', Auth::user()->group_no)
            ->whereNull('task_completed_date')
            ->count();

        $this->stu_per_done = round(($studentTotalTasks > 0) ? ($studentCompletedTasks / $studentTotalTasks) * 100 : 0, 0);
        $this->stu_task_remaining = 100 - $this->stu_per_done;

        // For Instructor Progress
        $instructorTotalTasks = Tasks::where('group_no', Auth::user()->group_no)->count();
        $instructorCompletedTasks = Tasks::where('group_no', Auth::user()->group_no)
            ->where('task_completed_date', '!=', null)
            ->where('task_status', 1)
            ->count();
        $instructorPendingTasks = Tasks::where('group_no', Auth::user()->group_no)
            ->where(function ($query) {
                $query->where('task_completed_date', null)
                    ->orWhere('task_status', 0)
                    ->orWhereNull('task_status');
            })
            ->count();

        $this->approved_per_done = round(($instructorTotalTasks > 0) ? ($instructorCompletedTasks / $instructorTotalTasks) * 100 : 0, 0);
        $this->approved_task_remaining = 100 - $this->approved_per_done;


        // dd( $this->stu_task_submitted);
    }

    public function mount()
    {
        $this->participants_count = User::where('group_no', Auth::user()->group_no)->count();
        $this->notification_count = Notifications::where('group_no', Auth::user()->group_no)->count();
        $this->repositories_count = Repositories::where('group_no', Auth::user()->group_no)->count();
        $this->tasks_count = Tasks::where('group_no', Auth::user()->group_no)->count();


        $this->accepted_proposal = Proposals::where("group_no", Auth::user()->group_no)->where("is_accepted", 1)->first();

        $this->fetchProgress();
    }

    public function render()
    {
        return view('livewire.student.student-dashboard');
    }
}
