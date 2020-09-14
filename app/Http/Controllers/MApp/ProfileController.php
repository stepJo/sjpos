<?php

namespace App\Http\Controllers\MApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MApp\UpdateProfileRequest;
use App\Http\Requests\MApp\UpdateLogoRequest;
use App\Services\MUserService;
use App\Models\MApp\Profile;
use Utilities;

class ProfileController extends Controller
{
    private $userService;

    public function __construct(MUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $views = $this->userService->menusRole();

        return view('mapp/profile', compact('views')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $profile->update($request->validated());

        return response()->json([
            'status'  => 'Success',
            'message' => 'Berhasil ubah profil aplikasi'
        ]);
    }

    public function updateLogo(UpdateLogoRequest $request, $id)
    {
        $profile = Profile::find($id);

        if($request->hasfile('image'))
        {   
            Utilities::deleteImage('profiles', $profile->app_logo);

            $image = Utilities::moveImage($request, 'profiles');

            $profile->app_logo = $image;

            $profile->save();
        }

        return response()->json([
            'status'  => 'Success',
            'message' => 'Berhasil ubah logo aplikasi'
        ]);
    }
}
