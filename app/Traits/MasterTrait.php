<?php

namespace App\Traits;

use App\Models\User;
use App\Models\T_user;
use App\Models\Fasilitas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

trait MasterTrait
{
    protected function idCreate($table, $field)
    {
        $id = IdGenerator::generate(['table' => $table, 'field' => $field, 'length' => 10, 'prefix' => date('ymd'), 'reset_on_prefix_change' => true]);
        return $id;
    }

    protected function idTuser()
    {
        $id = IdGenerator::generate(['table' => 't_user', 'field' => 'id_tuser', 'length' => 8, 'prefix' => '0', 'reset_on_prefix_change' => true]);
        return $id;
    }

    protected function idFasilitas()
    {
        $id = IdGenerator::generate(['table' => 't_fasilitas', 'field' => 'id_fasilitas', 'length' => 5, 'prefix' => 'FA']);
        return $id;
    }

    public function uploadImage($request, $path)
    {
        $image = null;

        if($request->file('image')) {
            $image = $request->file('image');
            $image->storeAs($path, $image->hashName());
        }

        return $image;
    }
}
