<?php 

namespace App\Services;

use App\Actions\ValidateData;
use App\DTOs\SettingDTO;
use App\Models\Settings;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SettingService
{
    private ValidateData $validateData;

    public function __construct(ValidateData $validateData)
    {
        $this->validateData = $validateData;      
    }

    public function getAllSettings(): \Illuminate\Support\Collection
    {
        $settings = Settings::all();

        return $settings->map(function ($setting) {
            $settingDTO = new SettingDTO($setting);

            return $settingDTO->toJsonArray();
        });
    }

    public function getSettingByKey(String $key): SettingDTO
    {
        $setting = Settings::where(['key' => $key])->first();

        if (!$setting) {
            throw new ModelNotFoundException('Setting not found');
        }

        return new SettingDTO($setting);
    }

    public function updateSetting(String $key, SettingDTO $settingDTO): SettingDTO
    {
        $setting = Settings::where(['key' => $key])->first();

        if (!$setting) {
            throw new ModelNotFoundException('Setting not found');
        }

        $validatedData = $this->validateData->execute($settingDTO);

        $setting->update([
            "value" => json_encode($validatedData["value"]),
        ]);

        return new SettingDTO($setting);
    }
}