<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $imageService;

    public function __construct(
        ImageService $imageService
    )
    {
        $this->imageService = $imageService;
    }

    public function createUser($request): void
    {
        $fileName = $this->imageService->uploadImage(imageObject: $request->file('avatar'), path: User::AVATARS_PATH);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $fileName,
        ]);

        $user->attachRole($request->role);
    }

    public function updateUser($request, $user): void
    {
        $fileName = $user->getRawOriginal('avatar');

        if ($request->file('avatar')) {
            $this->imageService->deleteImage(path: $user->getAvatarPath());

            $fileName = $this->imageService->uploadImage(
                imageObject: $request->file('avatar'),
                path: User::AVATARS_PATH
            );
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'avatar' => $fileName,
        ]);

        $user->detachRole($user->role);
        $user->attachRole($request->role);
    }


    public function deleteUser($user): ?bool
    {
        
        $this->imageService->deleteImage(path: $user->getAvatarPath());
        $user->detachRole($user->role);
        return  $user->delete();
    }
}
