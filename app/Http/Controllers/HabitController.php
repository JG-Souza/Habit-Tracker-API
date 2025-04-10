<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Http\Resources\HabitResource;
use App\Models\Habit;
use App\Models\HabitLog;

class HabitController extends Controller
{
    public function index()
    {
        return HabitResource::collection(
            Habit::query() // Isso diminui significativamente o número de consultas
            ->when(
                str(request()->string('with', ''))->contains('user'),
                fn ($query) => $query->with('user')
            )
            ->when(
                str(request()->string('with', ''))->contains('logs'),
                fn ($query) => $query->with('logs')
            )
            ->paginate()
        );
    }

    public function show(Habit $habit)
    {
        return HabitResource::make($habit);
    }

    public function store(StoreHabitRequest $request)
    {
        $habit = Habit::create(array_merge($request->validated(), ['user_id' => 1]));

        return HabitResource::make($habit);
    }

    public function update(UpdateHabitRequest $request, Habit $habit)
    {
        $habit->update($request->validated());

        return HabitResource::make($habit);
    }

    public function destroy(Habit $habit)
    {
        $habit->logs()->delete();

        $habit->delete();

        return response()->noContent();
    }
}
