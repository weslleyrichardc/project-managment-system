<?php

namespace App\Observers;

use App\Models\Address;
use App\Services\BrazilAPI;
use Illuminate\Http\Response;

class AddressZipCodeObserver
{
    /**
     * Handle the Address "creating" event.
     */
    public function creating(Address $address): void
    {
        if (
            ! array_key_exists('street', $address->toArray()) ||
            ! array_key_exists('neighborhood', $address->toArray()) ||
            ! array_key_exists('city', $address->toArray()) ||
            ! array_key_exists('state', $address->toArray())
        ) {
            $brazilApiInfo = BrazilAPI::getAddressFromCep($address->zip_code);

            abort_if(array_key_exists('message', $brazilApiInfo), Response::HTTP_UNPROCESSABLE_ENTITY, $brazilApiInfo['message'] ?? 'Invalid zip code');

            $address->street = $brazilApiInfo['street'];
            $address->neighborhood = $brazilApiInfo['neighborhood'];
            $address->city = $brazilApiInfo['city'];
            $address->state = $brazilApiInfo['state'];
        }
    }
}
