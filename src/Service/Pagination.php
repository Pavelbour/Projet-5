<?php

    namespace App\Service;

    class Pagination
    {
        public function numberPages($nombre, $epp)
        {
            if (($nombre % $epp) == 0) {
                return $nombre / $epp;
            } else {
                return ($nombre / $epp) + 1;
            }
        }
    }