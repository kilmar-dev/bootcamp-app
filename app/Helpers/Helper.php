<?php
namespace App\Helpers;

use Carbon\Carbon;
use phpseclib3\Crypt\AES;
use Illuminate\Support\Facades\Http;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Log;

class Helper
{
    public static function logs($data, $idUser, $action, $idTable, $table)
    {
        try {
            DB::beginTransaction();
            $log = new Log;
            $log->user_id=$idUser;
            $log->table_id=$idTable;
            $log->table=$table;
            $log->action=$action;
            $log->method=$data->method();
            $log->endpoint= $data->getRequestUri();
            $log->created_at = Carbon::now()->format('d-m-y');
            $log->save();
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }
}
