<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Spatie\Permission\Models\Role;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $id, $request, $avatar;

    public function __construct($id, $request, $avatar)
    {
        $this->id = $id;
        $this->request = $request;
        $this->avatar = $avatar;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // if (!empty($this->request->avatar)) {
        //     if ($files = $this->request->file('avatar')) {
        //         $fileName = $files->getClientOriginalName();
        //         $fileExt = $files->getClientOriginalExtension();
        //         $fileName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . Carbon::now()->timestamp;
        //         $file_path = 'storage/images/users/' . $fileName . '.' . $fileExt;
        //         $files->move('storage/images/users/', $fileName . '.' . $fileExt);
        //     }

        //     $this->data_user["avatar"] = $file_path;
        // }

        $data_user = [
            "name" => $this->request['name'],
            "email" => $this->request['email'],
        ];
        if (!empty($this->request['establish'])) {
            $data_user['establish'] = $this->request['establish'];
        }
        if (!empty($this->avatar)) {
            $data_user['avatar'] = $this->avatar;
        }

        $data = User::find($this->id);

        $role = Role::find($this->request['role_id']);

        $data->update($data_user);

        $data->syncRoles([$role->name]);

    }
}
