<?php


namespace App\Traits;


use http\Client\Response;

trait ResponseTrait
{

    /**
     * Format response.
     *
     * @return Response
     */
    static function formatResponse($_data, $_msg, $_status, $_isPaginate = false, $_page = null, $_per_page = null)
    {

        $total = ($_isPaginate)
            ? count($_data)
            : 1;

        $per_page = ($_per_page)
            ? $_per_page
            : $total;

        $page = ($_page)
            ? $_page
            : 1;

        if($total != 0){
            $last_page = (($total/$per_page ) <= $page)
                ? true
                : false;
        }
        else{
            $last_page = true;
        }

        $paginator = [];

        if($_isPaginate){

            $paginator =  ["paginate" => [
                "current_page" => $page,
                "page_size" => $per_page,
                "last_page" => $last_page,
                "total" => $total
            ]];

            $_data = $_data->slice(($page-1) * $per_page, $per_page)->values()->all();
        }

        return  response()->json(
            array_merge([
                "status" => $_status,
                "success" => true,
                "data" => $_data
            ],
                $paginator,
                ["message" => $_msg]
            ))->setStatusCode($_status);


    }
}
