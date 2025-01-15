<?php

namespace App\Helpers;

use Illuminate\Pagination\Paginator;

class PaginateHelper
{
    /**
     * @param Paginator $data
     * @param array $params
     * @return mixed
     * @codeCoverageIgnore
     */
    public static function paginateWithParams(Paginator $data, array $params = [])
    {
        if (!empty($data)) {
            foreach ($params as $title => $value) {
                $data->appends([$title => $value]);
            }

            return $data->links();
        }
    }
}
