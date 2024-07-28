<?php

namespace App\Livewire\SuperAdmin;

use Livewire\Component;
use App\Models\Proposals;
use App\Models\Tasks;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class SuperAdminTasks extends Component
{



    public $tasks, $week_no, $task_title, $task_due_date, $group_no;

    public $system_row = "system_group_dont_delete_row";

    public function create_task()
    {
        $new_task = new Tasks([
            "group_no" => $this->system_row,
            "week_no" => $this->week_no,
            "task_title" => $this->task_title,
            "task_due_date" => $this->task_due_date
        ]);
        $new_task->save();

        $all_groups = User::where("user_type", "instructor")->get();
        foreach ($all_groups as $group) {
            $new_task = new Tasks([
                "group_no" => $group->group_no,
                "week_no" => $this->week_no,
                "task_title" => $this->task_title,
                "task_due_date" => $this->task_due_date
            ]);
            $new_task->save();
        }
        $this->reset(['week_no', 'task_title', 'task_due_date']);
        $this->dispatch("task_created");
        $this->FetchTasks();
    }

    public function deleteTask($task_id)
    {
        try {

            $task = Tasks::where("task_id", $task_id)->first();
            $task->delete();
            $this->FetchTasks();

            $all_groups = User::where("user_type", "instructor")->get();

            foreach ($all_groups as $group) {
                // dd($group->group_no);
                Tasks::where("group_no", $group->group_no)->where("task_title", $task->task_title)->first()->delete();
            }
        } catch (Exception $e) {
            // dd($e);
        }
    }

    public function update_remark($remark, $task_id, $approved_or_rejected)
    {
        try {
            Tasks::where('task_id', $task_id)->update(['task_remark' => $remark, "task_status" => !$approved_or_rejected]);
        } catch (Exception $e) {
        }
        $this->FetchTasks();
    }

    public function FetchTasks()
    {
        $this->tasks = Tasks::where("group_no", $this->system_row)->orderBy("week_no", "ASC")->get();
        // dd($this->tasks);
    }

    public function create_default_tasks()
    {
        $tasks = [
            [
                'group_no' => $this->system_row,
                'task_title' => 'Abstract',
                "week_no" => '1',
                'task_due_date' => '2024-07-27',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'group_no' => $this->system_row,
                'task_title' => 'Introduction',
                "week_no" => '2',
                'task_due_date' => '2024-08-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'group_no' => $this->system_row,
                'task_title' => 'Review Of Literature - Part 1',
                "week_no" => '3',
                'task_due_date' => '2024-08-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'group_no' => $this->system_row,
                'task_title' => 'Review Of Literature - Part 2',
                "week_no" => '4',
                'task_due_date' => '2024-08-17',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'group_no' => $this->system_row,
                'task_title' => 'System Presentation - 1',
                "week_no" => '5',
                'task_due_date' => '2024-08-24',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'group_no' => $this->system_row,
                'task_title' => 'Design (Final)',
                "week_no" => '6',
                'task_due_date' => '2024-09-07',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'group_no' => $this->system_row,
                'task_title' => 'Implementation (25%)',
                "week_no" => '7',
                'task_due_date' => '2024-09-14',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'group_no' => $this->system_row,
                'task_title' => 'Implementation (50%)',
                "week_no" => '8',
                'task_due_date' => '2024-09-28',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'group_no' => $this->system_row,
                'task_title' => 'Implementation (50%)',
                "week_no" => '9',
                'task_due_date' => '2024-10-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'group_no' => $this->system_row,
                'task_title' => 'Synopsis Presentation - II',
                "week_no" => '10',
                'task_due_date' => '2024-11-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'group_no' => $this->system_row,
                'task_title' => 'Research Paper (Part - I ) Abstract, Introduction, LS, Proposed System',
                "week_no" => '11',
                'task_due_date' => '2024-11-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        $currentYear = now()->format('Y');

        $tasks = array_map(function ($task) use ($currentYear) {
            $task['task_due_date'] = $currentYear . substr($task['task_due_date'], 4); // Keep the month and day part unchanged
            return $task;
        }, $tasks);

        Tasks::insert($tasks);

        $this->FetchTasks();

        $all_groups = User::where("user_type", "instructor")->get();

        foreach ($all_groups as $group) {

            $tasks = [
                [
                    'group_no' => $group->group_no,
                    'task_title' => 'Abstract',
                    "week_no" => '1',
                    'task_due_date' => '2024-07-27',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'group_no' => $group->group_no,
                    'task_title' => 'Introduction',
                    "week_no" => '2',
                    'task_due_date' => '2024-08-03',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'group_no' => $group->group_no,
                    'task_title' => 'Review Of Literature - Part 1',
                    "week_no" => '3',
                    'task_due_date' => '2024-08-10',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'group_no' => $group->group_no,
                    'task_title' => 'Review Of Literature - Part 2',
                    "week_no" => '4',
                    'task_due_date' => '2024-08-17',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'group_no' => $group->group_no,
                    'task_title' => 'System Presentation - 1',
                    "week_no" => '5',
                    'task_due_date' => '2024-08-24',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'group_no' => $group->group_no,
                    'task_title' => 'Design (Final)',
                    "week_no" => '6',
                    'task_due_date' => '2024-09-07',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'group_no' => $group->group_no,
                    'task_title' => 'Implementation (25%)',
                    "week_no" => '7',
                    'task_due_date' => '2024-09-14',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'group_no' => $group->group_no,
                    'task_title' => 'Implementation (50%)',
                    "week_no" => '8',
                    'task_due_date' => '2024-09-28',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'group_no' => $group->group_no,
                    'task_title' => 'Implementation (50%)',
                    "week_no" => '9',
                    'task_due_date' => '2024-10-05',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'group_no' => $group->group_no,
                    'task_title' => 'Synopsis Presentation - II',
                    "week_no" => '10',
                    'task_due_date' => '2024-11-12',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'group_no' => $group->group_no,
                    'task_title' => 'Research Paper (Part - I ) Abstract, Introduction, LS, Proposed System',
                    "week_no" => '11',
                    'task_due_date' => '2024-11-20',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

            ];

            Tasks::insert($tasks);
        }
    }



    public function mount()
    {
        $this->group_no = Auth::user()->group_no;
        $this->FetchTasks();
    }

    public function render()
    {
        return view('livewire.super-admin.super-admin-tasks');
    }
}
