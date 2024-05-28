<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Models\Subscription;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{

    public function store(SubscriptionRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $subscription = Subscription::create($validated);

        try {
            $mail = new WelcomeMail($subscription);
            Mail::to($subscription->email)->send($mail);

            Log::info('Mail sent to: ' . $subscription->email, [
                'subject' => $mail->subject,
                'body' => $mail->render()
            ]);

            return response()->json([
                'status' => 200,
                'validated' => $validated,
                'id' => $subscription->id,
                'message' => $mail->render(),
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send mail to: ' . $user->email . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Subscription created, but failed to send email'], 201);
        }
    }
}
