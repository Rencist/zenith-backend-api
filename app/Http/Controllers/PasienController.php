<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Core\Application\Service\GetPasien\GetPasienService;
use App\Core\Application\Service\CreatePasien\CreatePasienRequest;
use App\Core\Application\Service\CreatePasien\CreatePasienService;

class PasienController extends Controller
{

    /**
     * @throws Exception
     */
    public function createPasien(Request $request, CreatePasienService $service): JsonResponse
    {
        $request->validate([
            'name' => 'min:2|max:128|string',
            'no_telp' => 'min:2|max:20|string',
            'alamat' => 'min:2|max:128|string'
        ]);

        $input = new CreatePasienRequest(
            $request->input('name'),
            $request->input('no_telp'),
            $request->input('alamat'),
            $request->file('foto')
        );

        DB::beginTransaction();
        try {
            $service->execute($input);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $this->success();
    }

    public function getPasien(GetPasienService $service): JsonResponse
    {
        return $this->successWithData($service->execute());
    }

}
