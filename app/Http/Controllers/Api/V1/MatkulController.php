<?php

namespace App\Http\Controllers\Api\V1;

use App\Matkul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MatkulController extends Controller
{
    public function findAll()
    {
        try {
            $data = Matkul::all();
            return $this->ok('success get all matkul', $data);
        }

        catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->internalServerError('internal server error', $e->getMessage());
        }
    }


    public function findbyId ($id)
    {
        try {
            $data = Matkul::find($id);
            if (!$data) {
                return $this->badRequest('matkul id = ' . $id . ' not found');
            }
            return $this->ok('success get matkul by id', $data);
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

            $data       = new Matkul();
            $data->name = $request->name;
            $data->slug = Str::slug($data->name, '-');
            $data->save();

            DB::commit();

            return $this->created('matkul has been added', $data);
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

            $data       = Matkul::find($request->id);
            $data->name = $request->name;
            $data->slug = Str::slug($data->name, '-');
            $data->update();

            DB::commit();

            return $this->created('matkul has been update', $data);
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

            $data = Matkul::find($request->id);
            if (!$data) {
                return $this->badRequest('matkul id = ' . $request->id . ' not found');
            }
            $data->delete();
            return $this->ok('success delete matkul by id', $data);
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->internalServerError('internal server error', $e->getMessage());
        }
    }
}
