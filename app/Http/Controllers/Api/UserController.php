<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Users\Store;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTrait;

    public function store(Store $request)
    {
        if ($request->type == 'first') {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'bio' => $request->bio,
            ]);
        } elseif ($request->type == 'second') {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'bio' => $request->bio,
                'file_name' => $request->file_name,
            ]);
            foreach ($request->file as $file) {
                $user->photo()->create([
                    'file' => $file
                ]);
            }
        } else {
            $user = User::create($request->validated());
                foreach ($request->file as $file) {
                    $user->photo()->create([
                        'file' => $file
                    ]);
                }
        }
        return $this->response('success', 'تم اضافه المستخدم بنجاح');
    }
}
