<?php

namespace App\Livewire\Student;

use App\Models\Proposals;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentProposals extends Component
{

    public $proj_name, $proj_description, $proj_domain, $user_name;

    public $proposals;
    public $show_table = false;


    public function submitProposal()
    {

        $this->validate([
            'proj_name' => 'required|string',
            'proj_description' => 'required|string',
            'proj_domain' => 'required|string',

        ]);

        $proposals = Proposals::where("group_no", Auth::user()->group_no)->where("is_accepted", null)->get();
        $proposal_accepted = Proposals::where("group_no", Auth::user()->group_no)->where("is_accepted", 1)->get();

        if ($proposals->count() != 5) {
            $new_proposal = new Proposals([
                "proposal_name" => $this->proj_name,
                'proposal_description' => $this->proj_description,
                'proposal_domain' => $this->proj_domain,
                'group_no' => Auth::user()->group_no,
                'student' => Auth::user()->name,
            ]);
            $new_proposal->save();
            $this->dispatch("proposal", ["message" => "Proposal Submitted Successfully!!"]);
        }

        // if (!$this->toggleTable()) {
        //     $this->dispatch("proposal", ["message" => "Max Numbers Of Proposals Submitted!"]);
        // }
        $this->Fetchproposals();

    }

    public function Fetchproposals()
    {
        $this->proposals = Proposals::where("group_no", Auth::user()->group_no)->get();
    }

    public function toggleTable()
    {
        $proposals = Proposals::where("group_no", Auth::user()->group_no)->where("is_accepted", null)->get();
        $proposals_2 = Proposals::where("group_no", Auth::user()->group_no)->where("is_accepted", 1)->get();

        if ($proposals->count() < 3 && $proposals_2->count() == 0) {
            $this->show_table = true;
        } else {
            $this->show_table = false;
        }
        return $this->show_table;
    }

    public function mount()
    {

        $this->toggleTable();
        $this->Fetchproposals();
    }

    public function render()
    {
        return view('livewire.student.student-proposals');
    }
}
