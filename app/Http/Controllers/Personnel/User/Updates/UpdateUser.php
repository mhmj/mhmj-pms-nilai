<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16/7/2020
 * Time: 10:41 AM
 */

namespace App\Http\Controllers\Personnel\User\Updates;

use App\User;
use App\Http\Resources\User as UserResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateUser
{
    /** @var  User */
    private $repository;

    /**
     * CreateUser constructor.
     * @param User $repository
     */
    public function __construct(User $repository)
    {
        $this->repository = $repository;
    }

    public function update($id, Request $request)
    {
        $data = $this->repository->findOrFail($id);

        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone_no = $request->input('phone_no');
        $data->role = $request->input('role');
        $data->company_id = $request->input('company_id');
        $data->remark = $request->input('remark');

        if($data->save()){
            return $data;
        }
    }

    public function checkpassword($id,$password)
    {
        $profile = $this->repository->findOrFail($id);

        if(Hash::check( $password, $profile->password))
        {
            return with('same');
        }
        else
        {
            return with('not');
        }
    }

    public function changePassword($id,$new_password)
    {
        $profile = $this->repository->findOrFail($id);

        $profile->password = Hash::make($new_password);

        $profile->save();

        return new UserResources($profile);

    }

}