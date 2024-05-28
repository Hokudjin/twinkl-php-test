<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Models\Subscription;
use App\Http\Requests\SubscriptionRequest;

class SubscriptionController extends Controller
{

    public function store(SubscriptionRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $subscription = Subscription::create($validated);

        return response()->json([
            'status' => 200,
            'validated' => $validated,
            'id' => $subscription->id,
        ]);
    }
}
