<?php

namespace App\Http\Controllers;

use App\DTOs\SettingDTO;
use App\Models\Settings;
use App\Services\SettingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    private SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $settings = $this->settingService->getAllSettings();
        return response()->json($settings);
    }

    public function show(String $key)
    {
        try {
            $setting = $this->settingService->getSettingByKey($key);

            return response()->json($setting->toJsonArray(), Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, String $key)
    {
        try {
            $updatedSetting = $this->settingService->updateSetting(
                $key,
                new SettingDTO($request->all()),
            );

            return response()->json($updatedSetting->toJsonArray(), Response::HTTP_OK);
        
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);

        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateMultiple(Request $request)
    {
        $settingsData  = $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'required',
        ]);

        try {

            $updatedSettings = [];

            foreach ($settingsData['settings'] as $settingData) {
                // Extract the key and the value for updating
                $key = $settingData['key'];
                $value = $settingData['value'];

                // Create a new SettingDTO  and update the setting
                $updatedSetting = $this->settingService->updateSetting(
                    $key,
                    new SettingDTO(['key' => $key, 'value' => $value]),
                );

                // Add updated settings to the array
                $updatedSettings[] = $updatedSetting->toJsonArray();
            }

            return response()->json($updatedSettings, Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);

        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
