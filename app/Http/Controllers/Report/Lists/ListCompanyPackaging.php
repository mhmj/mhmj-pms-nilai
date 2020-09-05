<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27/8/2020
 * Time: 10:28 AM
 */

namespace App\Http\Controllers\Report\Lists;


use App\Movement;
use Illuminate\Support\Facades\DB;

class ListCompanyPackaging
{
    /** @var  Movement */
    private $movement;

    /**
     * ListCompanyPackaging constructor.
     * @param Movement $movement
     */
    public function __construct(Movement $movement)
    {
        $this->movement = $movement;
    }

    public function companyPackaging($companyId)
    {
        $result = DB::select(DB::raw("SELECT 
                                            movement.type_name, 
                                            category.name as Category, 
                                            COUNT( CASE WHEN movement.status_received = 'OUT' THEN 1 END ) AS customer, 
                                            COUNT( CASE WHEN movement.remark = 'Damage' THEN 1 END ) AS Damage, 
                                            company.name 
                                            FROM type, movement, category, company, shipment WHERE 
                                            shipment.id = movement.shipment_id AND 
                                            company.id = shipment.company_id AND 
                                            type.name = movement.type_name AND 
                                            category.id = type.category_id AND
                                            company.id = '".$companyId."'
                                            GROUP BY movement.type_name, category.name, company.name"
        ));

        return response()->json($result);
    }

    public function AllCompanyPackaging()
    {
        $result = DB::select(DB::raw("SELECT 
                                            movement.type_name, 
                                            category.name as Category, 
                                            COUNT( CASE WHEN movement.status_received = 'OUT' THEN 1 END ) AS customer, 
                                            COUNT( CASE WHEN movement.remark = 'Damage' THEN 1 END ) AS Damage, 
                                            company.name 
                                            FROM type, movement, category, company, shipment WHERE 
                                            shipment.id = movement.shipment_id AND 
                                            company.id = shipment.company_id AND 
                                            type.name = movement.type_name AND 
                                            category.id = type.category_id
                                            GROUP BY movement.type_name, category.name, company.name"
        ));

        return response()->json($result);
    }

}