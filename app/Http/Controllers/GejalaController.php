<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Core\Application\Service\CreateGejala\CreateGejalaRequest;
use App\Core\Application\Service\CreateGejala\CreateGejalaService;

class GejalaController extends Controller
{

    /**
     * @throws Exception
     */
    public function createGejala(Request $request, CreateGejalaService $service): JsonResponse
    {
        $request->validate([
            'name' => 'min:2|max:128|string'
        ]);

        $input = new CreateGejalaRequest(
            $request->input('name')
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

}
