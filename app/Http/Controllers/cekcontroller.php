<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cekcontroller extends Controller
{
    public function index(Request $request)
    {
        try {

            $connection = DB::connection();
            $pdo = $connection->getPdo();

            $tableName = $request->input('table');


            if ($tableName) {
                $data = DB::table($tableName)->get();
                $count = count($data);

                return response()->json([
                    'status' => 'suksess',
                    'message' => 'Data berhasil diambil',
                    'table' => $tableName,
                    'total_records' => $count,
                    'data' => $data
                ], 200);
            }


            $tables = DB::select('SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE()');

            $tableList = [];
            foreach ($tables as $table) {
                $name = $table->TABLE_NAME;
                $count = DB::table($name)->count();
                $preview = DB::table($name)->limit(2)->get();

                $tableList[] = [
                    'name' => $name,
                    'total_records' => $count,
                    'preview' => $preview
                ];
            }

            return response()->json([
                'status' => 'success',
            'message' => 'Database terhubung ',
                'total_tables' => count($tableList),
                'tables' => $tableList,

            ], 200);

        } catch (\Exception $e) {
            // Jika gagal
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),

            ], 500);
        }
    }
}

