<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26/8/2020
 * Time: 11:21 AM
 */

namespace App\Http\Controllers\Report\Lists;


use App\Packaging;
use Illuminate\Support\Facades\DB;

class ListAllPackaging
{
    /** @var  Packaging */
    private $packaging;

    /**
     * ListAllPackaging constructor.
     * @param Packaging $packaging
     */
    public function __construct(Packaging $packaging)
    {
        $this->packaging = $packaging;
    }

    public function allPackaging()
    {
        $result = DB::select(DB::raw("SELECT 
                                            packaging.type_name, 
                                            COUNT( CASE WHEN packaging.status = 'IN' THEN 1 END ) AS warehouse,
                                            COUNT( CASE WHEN packaging.status = 'OUT' THEN 1 END ) AS customer,
                                            COUNT( CASE WHEN packaging.remark = 'Damage' THEN 1 END ) AS damage,
                                            category.name,
                                            type.description
                                              
                                            FROM packaging,category, type 
                                            WHERE category.id = packaging.category_id AND
                                            type.name = packaging.type_name
                                            GROUP BY packaging.type_name,category.name,type.description
                                            ORDER BY category.name"
        ));

        return response()->json($result);

    }


}