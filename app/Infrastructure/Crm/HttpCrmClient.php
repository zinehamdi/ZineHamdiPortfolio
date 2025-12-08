<?php

namespace App\Infrastructure\Crm;

use App\Application\Contracts\CrmClient;
use App\Domain\Contacts\Subscription;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class HttpCrmClient implements CrmClient
{
    public function syncSubscription(Subscription $subscription): void
    {
        $config = config('services.crm', []);
        $endpoint = rtrim((string) ($config['endpoint'] ?? ''), '/');

        if ($endpoint === '') {
            Log::warning('CRM endpoint missing, skipping subscription sync', [
                'subscription_id' => $subscription->id,
            ]);

            return;
        }

        $payload = $this->payload($subscription);
        $token = $config['token'] ?? null;
        $timeout = (int) ($config['timeout'] ?? 5);
        $url = $endpoint.'/subscriptions';

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->retry(2, 200)
                ->timeout($timeout)
                ->when(filled($token), static fn ($request) => $request->withToken($token))
                ->post($url, $payload);

            $response->throw();

            Log::info('Subscription synced with CRM', [
                'subscription_id' => $subscription->id,
                'crm_response_status' => $response->status(),
            ]);
        } catch (RequestException $exception) {
            Log::error('CRM sync failed (HTTP)', [
                'subscription_id' => $subscription->id,
                'status' => optional($exception->response)->status(),
                'body' => optional($exception->response)->body(),
                'message' => $exception->getMessage(),
            ]);

            throw $exception;
        } catch (Throwable $exception) {
            Log::error('CRM sync failed (general)', [
                'subscription_id' => $subscription->id,
                'message' => $exception->getMessage(),
            ]);

            throw $exception;
        }
    }

    /**
     * Build CRM payload.
     *
     * @return array<string,mixed>
     */
    private function payload(Subscription $subscription): array
    {
        $data = [
            'id' => $subscription->id,
            'email' => $subscription->email,
            'plan' => $subscription->plan,
            'status' => $subscription->status,
            'renews_at' => optional($subscription->renews_at)->toAtomString(),
            'created_at' => optional($subscription->created_at)->toAtomString(),
            'updated_at' => optional($subscription->updated_at)->toAtomString(),
        ];

        return Arr::where($data, static fn ($value) => $value !== null);
    }
}
