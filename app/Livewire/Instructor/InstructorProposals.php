<?php

namespace App\Livewire\Instructor;

use App\Models\Notifications;
use Livewire\Component;
use App\Models\Proposals;
use Illuminate\Support\Facades\Auth;

class InstructorProposals extends Component
{

    public $proposals;

    public function MarkasRejected($id){
        $proposal = Proposals::where("proposal_id", $id)->first();
        $proposal->is_accepted = 0;
        $msg = "The Proposal of ".$proposal->proposal_name." has been Rejected!";
        $new_notification = new Notifications([
            "group_no" => Auth::user()->group_no,
            "notification_title" => "Proposal Updates",
            "notification_message" => $msg
        ]);
        $new_notification->save();

        $proposal->save();
        $this->Fetchproposals();
    }

    public function MarkasAccepted($id){
        $proposal = Proposals::where("proposal_id", $id)->first();
        $proposal->is_accepted = 1;
        $msg = "The Proposal of ".$proposal->proposal_name." has been Accepted!";
        $new_notification = new Notifications([
            "group_no" => Auth::user()->group_no,
            "notification_title" => "Proposal Updates",
            "notification_message" => $msg
        ]);
        $new_notification->save();

        $proposal->save();
        $this->Fetchproposals();
    }

    public function ToggleProposals($id)
    {

        $msg = "";

        $proposal = Proposals::where("proposal_id", $id)->first();

        if ($proposal) {
            if ($proposal->is_accepted == null) {
                $proposal->is_accepted = 1;
            } else {
                $proposal->is_accepted = !$proposal->is_accepted;
            }
        }

        if($proposal->is_accepted){
            $msg = "The Proposal of ".$proposal->proposal_name." has been Accepted!";
        }else{
            $msg = "The Proposal of ".$proposal->proposal_name." has been Rejected!";
        }

        $new_notification = new Notifications([
            "group_no" => Auth::user()->group_no,
            "notification_title" => "Proposal Updates",
            "notification_message" => $msg
        ]);
        $new_notification->save();

        $proposal->save();
        $this->Fetchproposals();
    }

    public function Fetchproposals()
    {
        $this->proposals = Proposals::where("group_no", Auth::user()->group_no)->get();
    }

    public function mount()
    {
        $this->Fetchproposals();
    }
    public function render()
    {
        return view('livewire.instructor.instructor-proposals');
    }
}
