<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Models\Track;
use Illuminate\Http\Request;

class ClickController extends Controller
{
    public function track(Request $request)
    {
        $link = $request->input('link');
        $data = json_decode($request->input('data'));

        if ($link && $data && $this->validateData($data)) {
            $this->createTrack($data, $request->ip());
            $this->updateClickCounts($data);

            return redirect($link);
        }

        abort(404);
    }

    private function validateData($data)
    {
        return isset($data->type) && isset($data->id, $data->is_featured);
    }

    private function createTrack($data, $ip): void
    {
        $timeChecker = now()->format('Y-m-d-H');

        $matchThese = [
            'belongs_to_type' => $data->type,
            'belongs_to' => $data->id,
            'type' => 'click',
            'ip' => $ip,
            'time_checker' => $timeChecker,
            'is_featured' => $data->is_featured,
        ];

        if (! Track::query()->where($matchThese)->exists()) {
            Track::create($matchThese);
        }
    }

    private function updateClickCounts($data): void
    {
        $object = null;
        $clickType = null;

        switch ($data->type) {
            case 'store':
                $object = \App\Models\Store::find($data->id);
                $clickType = 'click_list';

                break;
            case 'product':
                $object = \App\Models\Product::find($data->id);
                $clickType = 'click_url';

                break;
                // Add more cases as needed
        }

        if ($object && $clickType) {
            $object->tracks->$clickType = optional($object->tracks)->$clickType + 1;
            $object->save();
        }
    }
}
