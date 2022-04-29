<?php

namespace App\Shared\Service;

use Illuminate\Support\Facades\DB;

class DBManager
{
    public function begin()
    {
        DB::beginTransaction();
    }

    public function rollback()
    {
        DB::rollBack();
    }

    public function commit()
    {
        DB::commit();
    }
}
