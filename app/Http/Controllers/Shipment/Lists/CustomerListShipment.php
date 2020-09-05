<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13/8/2020
 * Time: 5:47 PM
 */

namespace App\Http\Controllers\Shipment\Lists;

use App\Shipment;
use App\Http\Resources\Shipment as ShipmentResources;

class CustomerListShipment
{
    /** @var  Shipment */
    private $repository;

    /**
     * ListShipment constructor.
     * @param Shipment $repository
     */
    public function __construct(Shipment $repository)
    {
        $this->repository = $repository;
    }

    public function list($id)
    {
        $data = $this->repository->where('company_id',$id)->get();

        return ShipmentResources::collection($data);
    }
}