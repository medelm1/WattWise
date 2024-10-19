<?php

namespace App\Http\Controllers;

use App\DTOs\ApplianceDTO;
use App\Services\ApplianceService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ApplianceController extends Controller
{
    private ApplianceService $applianceService;

    public function __construct(ApplianceService $applianceService)
    {
        $this->applianceService = $applianceService;
    }

    /**
     * Display a listing of all appliances.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $appliances = $this->applianceService->getAllAppliances();
        
        return response()->json($appliances);
    }

    /**
     * Display a specific appliance by its ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $applianceDTO = $this->applianceService->getApplianceById($id);

            return response()->json($applianceDTO->toJsonArray(), Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created appliance in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $newCreatedApplianceDTO = $this->applianceService->createAppliance(
                new ApplianceDTO($request->all())
            );

            return response()->json($newCreatedApplianceDTO->toJsonArray(), Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
