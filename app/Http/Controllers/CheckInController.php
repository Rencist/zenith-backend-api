<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Core\Application\Service\GetCheckIn\GetCheckInService;
use App\Core\Application\Service\CreateCheckIn\CreateCheckInRequest;
use App\Core\Application\Service\CreateCheckIn\CreateCheckInService;
use App\Core\Domain\Models\UserAccount;

class CheckInController extends Controller
{

    /**
     * @throws Exception
     */
    public function createCheckIn(Request $request, CreateCheckInService $service): JsonResponse
    {
        $request->validate([
            'penyakit' => 'min:2|max:128|string'
        ]);

        $input = array_map(function (array $pasien) {
                return new CreateCheckInRequest(
                    $pasien['gejala']
                );
            }, $request->input('pasien'));

        DB::beginTransaction();
        try {
            $service->execute($input, $request->get('account'), $request->input('penyakit'));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $this->success();
    }

}
