<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Core\Application\Service\PasienMe\PasienMeService;
use App\Core\Application\Service\GetPasien\GetPasienService;
use App\Core\Application\Service\LoginPasien\LoginPasienRequest;
use App\Core\Application\Service\LoginPasien\LoginPasienService;
use App\Core\Application\Service\CreatePasien\CreatePasienRequest;
use App\Core\Application\Service\CreatePasien\CreatePasienService;
use App\Core\Application\Service\GetPasienDetail\GetPasienDetailRequest;
use App\Core\Application\Service\GetPasienDetail\GetPasienDetailService;

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
            $request->file('foto'),
            $request->input('password'),
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

    public function loginPasien(Request $request, LoginPasienService $service): JsonResponse
    {
        $input = new LoginPasienRequest(
            $request->input('no_telp'),
            $request->input('password')
        );
        $response = $service->execute($input);
        return $this->successWithData($response);
    }

    public function getPasien(GetPasienService $service): JsonResponse
    {
        return $this->successWithData($service->execute());
    }

    public function getPasienDetail(string $pasien_id, GetPasienDetailService $service): JsonResponse
    {
        $input = new GetPasienDetailRequest($pasien_id);
        $response = $service->execute($input);
        return $this->successWithData($response);
    }

    public function me(Request $request, PasienMeService $service): JsonResponse
    {
        $response = $service->execute($request->get('account'));
        return $this->successWithData($response);
    }

}
