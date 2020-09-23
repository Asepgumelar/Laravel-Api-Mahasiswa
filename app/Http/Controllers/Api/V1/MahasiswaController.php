<?php

namespace App\Http\Controllers\Api\V1;

use App\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function findAll ()
    {
        try {
            $data = Mahasiswa::all();
            return $this->ok('success get all mahasiswa', $data);
        }

        catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->internalServerError('internal server error', $e->getMessage());
        }
    }

    public function findbyId ($id)
    {
        try {
            $data = Mahasiswa::find($id);
            if (!$data) {
                return $this->badRequest('mahasiswa id = ' . $id . ' not found');
            }
            return $this->ok('success get mahasiswa by id', $data);
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->internalServerError('internal server error', $e->getMessage());
        }
    }

    public function  postCreate (Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->badRequest('required');
            }

            $data       = new Mahasiswa();
            $data->name = $request->name;
            $data->save();

            DB::commit();

            return $this->created('mahasiswa has been added', $data);
        }

        catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return $this->internalServerError('internal server error', $e->getMessage());
        }
    }
    public function postUpdate (Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id'   => 'required',
                'name' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->badRequest('required');
            }

            $data       = Mahasiswa::find($request->id);
            $data->name = $request->name;
            $data->update();

            DB::commit();

            return $this->created('mahasiswa has been update', $data);
        }
        catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return $this->internalServerError('internal server error', $e->getMessage());
        }
    }
    public function delete (Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id'   => 'required',
            ]);

            if ($validator->fails()) {
                return $this->badRequest('required');
            }

            $data = Mahasiswa::find($request->id);
            if (!$data) {
                return $this->badRequest('mahasiswa id = ' . $request->id . ' not found');
            }
            $data->delete();
            return $this->ok('success delete mahasiswa by id', $data);
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->internalServerError('internal server error', $e->getMessage());
        }
    }
}
