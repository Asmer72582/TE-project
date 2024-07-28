<?php

namespace App\Livewire\Instructor;

use App\Models\Repositories;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class InstructorRepositories extends Component
{
    use WithFileUploads;

    public $files;

    public $folder_name;

    public $ffs;

    public $current_folder;

    public $previous_folder;

    public function openFolder($current_folder)
    {
        $this->current_folder = $current_folder;
        array_push($this->previous_folder, $current_folder);
        $this->fetchAll();
    }

    public function DownloadFile($file_id)
    {
        $file = Repositories::where([['ff_id', $file_id]])->first();
        $filePath = storage_path('app/' . $file->file_path);
        if (File::exists($filePath)) {
            return response()->download($filePath, $file->ff_title);
        }

        abort(404);
    }

    public function goBackFolder()
    {
        array_pop($this->previous_folder);
        $this->current_folder = $this->previous_folder[count($this->previous_folder) - 1];
        $this->fetchAll();
    }

    public function deleteFF($id)
    {
        $repo = Repositories::where("ff_id", $id)->first();
        // dd($repo);
        if ($repo) {
            $repo->delete();
            $this->fetchAll();
            $this->dispatch("file_deleted");
        }
    }

    public function create_folder()
    {

        if (strlen($this->folder_name) == 0) {
            $this->dispatch("invalid_folder_name");
            return;
        }

        $new_folder = new Repositories([
            "group_no" => Auth::user()->group_no,
            "is_folder" => true,
            "sub_ff_of" => $this->current_folder,
            "ff_title" => $this->folder_name,
        ]);

        $new_folder->save();

        $this->reset(["folder_name"]);

        $this->fetchAll();
    }

    function formatFileSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function uploadFile()
    {
        $this->validate([
            'files.*' => 'required|file',
        ]);

        $group_no = Auth::user()->group_no;

        try {
            foreach ($this->files as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $fileSize = $this->formatFileSize($file->getSize());
                $uniqueFileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file_path = $file->storeAs('public/files', $uniqueFileName);

                $new_file = new Repositories([
                    "group_no" => $group_no,
                    "is_folder" => false,
                    "file_path" => $file_path,
                    "ff_title" => $fileName,
                    "file_size" => $fileSize,
                    "sub_ff_of" => $this->current_folder,
                ]);
                $new_file->save();
            }

            $this->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function fetchAll()
    {


        if ($this->current_folder == null) {
            $this->ffs = Repositories::where("group_no", Auth::user()->group_no)->where("sub_ff_of", null)->get();
        } else {
            $this->ffs = Repositories::where("group_no", Auth::user()->group_no)->where("sub_ff_of", $this->current_folder)->get();
        }
    }

    public function mount()
    {
        $this->current_folder = null;
        $this->previous_folder = [null];
        $this->fetchAll();
    }

    public function render()
    {
        return view('livewire.instructor.instructor-repositories');
    }
}
