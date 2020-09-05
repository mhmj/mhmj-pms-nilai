<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21/7/2020
 * Time: 1:40 PM
 */

namespace App\Http\Controllers\Movement\Lists;

use App\Movement;
use App\Http\Resources\Movement as MovementResources;

class ListMovement
{

    /** @var  Movement */
    private $repository;

    /**
     * ListPackagingBasedOnShipment constructor.
     * @param Movement $repository
     */
    public function __construct(Movement $repository)
    {
        $this->repository = $repository;
    }

    public function list($id)
    {
        $data = $this->repository->where('shipment_id', $id)->get();

        return MovementResources::collection($data);
    }

    public function CustomerListMovementIN($id)
    {
        $data = $this->repository->where('shipment_id', $id)
                                 ->where('status_received', 'OUT')
                                 ->get();

        return MovementResources::collection($data);
    }

    public function CustomerListMovementOUT($id)
    {
        $data = $this->repository->where('shipment_id', $id)
                                 ->where('status_received', 'IN')
                                 ->get();

        return MovementResources::collection($data);
    }
}