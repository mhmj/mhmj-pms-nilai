<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/8/2020
 * Time: 9:03 AM
 */

namespace App\Http\Controllers\Packaging\Lists;


use App\Packaging;
use App\Http\Resources\Packaging as PackagingResources;

class ListPackagingDetails
{
    /** @var  Packaging */
    private $repository;

    /**
     * ListPackagingDetails constructor.
     * @param Packaging $repository
     */
    public function __construct(Packaging $repository)
    {
        $this->repository = $repository;
    }

    public function list($packaging_no)
    {
        $data = $this->repository->where('packaging_no', $packaging_no)->get();
        return PackagingResources::collection($data);
        //return response()->json($data);
    }

    public function statusPackage($packaging_no)
    {
        $data = $this->repository->where('packaging_no', $packaging_no)->first();
        if($data->status == 'OUT')
        {
            return with('no');
        }
        if($data->status == 'IN')
        {
            return with('yes');
        }
    }


}