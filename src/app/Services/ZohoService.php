<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZohoService
{
    private function getAccessToken()
    {
        $response = Http::asForm()->post(
            'https://accounts.zoho.jp/oauth/v2/token',
            [
                'refresh_token' => config('services.zoho.refresh_token'),
                'client_id' => config('services.zoho.client_id'),
                'client_secret' => config('services.zoho.client_secret'),
                'grant_type' => 'refresh_token',
            ]
        );

        return $response->json()['access_token'];
    }

    public function createContact($name, $email)
    {
        $token = $this->getAccessToken();

        return Http::withToken($token)
            ->post(config('services.zoho.base_url') . '/crm/v2/Contacts', [
                'data' => [
                    [
                        'Last_Name' => $name,
                        'Email' => $email,
                    ]
                ]
            ])
            ->json();
    }

    public function createDeal($title, $date, $time, $number, $contactId = null)
    {
        $token = $this->getAccessToken();

        $dealData = [
            'Deal_Name' => $title,
            'Stage' => 'Qualification',
            'Closing_Date' => $date,
            'Description' => "予約時間: {$time} / 人数: {$number}",
        ];

        if (!empty($contactId)) {
            $dealData['Contact_Name'] = [
                'id' => $contactId
            ];
        }

        return Http::withToken($token)
            ->post(config('services.zoho.base_url') . '/crm/v2/Deals', [
                'data' => [
                    $dealData
                ]
            ])
            ->json();
    }

    public function deleteDeal($dealId)
    {
        $token = $this->getAccessToken();

        return Http::withToken($token)
            ->delete(config('services.zoho.base_url') . "/crm/v2/Deals/{$dealId}")
            ->json();
    }

    public function updateDeal($dealId, $date, $time, $number)
    {
        $token = $this->getAccessToken();

        return Http::withToken($token)
            ->put(config('services.zoho.base_url') . "/crm/v2/Deals/{$dealId}", [
                'data' => [
                    [
                        'Closing_Date' => $date,
                        'Description' => "予約時間: {$time} / 人数: {$number}"
                    ]
                ]
            ])
            ->json();
    }

    public function uploadAttachmentToDeal($dealId, $filePath)
    {
        $token = $this->getAccessToken();

        return Http::withToken($token)
            ->attach(
                'file',
                file_get_contents($filePath),
                basename($filePath)
            )
            ->post(config('services.zoho.base_url') . "/crm/v8/Deals/{$dealId}/Attachments")
            ->json();
    }
}