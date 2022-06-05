<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Query\GetGroomingList\GetGroomingListInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroomingController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private GetGroomingListInterface $getGroomingList
    ){ }

    public function getGroomingList(Request $request): JsonResponse
    {
        $rules = [
            'offset' => 'required',
            'limit' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $this->db_manager->begin();

        try {
            $response = $this->getGroomingList->execute(
                $request->input('offset'),
                $request->input('limit'),
            );
            $this->db_manager->commit();
        }catch (Exception $e){
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->successWithData($response);
    }
}
