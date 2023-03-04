<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * Store a newly created address.
     */
    public function store(StoreAddressRequest $request)
    {
        if (! auth()->check()) {
            return response()->json([
                'message' => 'You must be logged in to create an address.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $addressData = $request->validated();
        $addressData['user_id'] = auth()->id();

        $address = Address::create($addressData);

        return response()->json($address, Response::HTTP_CREATED);
    }

    /**
     * Update the specified address.
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->update($request->validated());

        return response()->json($address, Response::HTTP_OK);
    }

    /**
     * Delete the specified address.
     */
    public function destroy(Address $address)
    {
        if (! auth()->check() || auth()->id() !== $address->user_id) {
            return response()->json([
                'message' => 'You must be logged in as the owner of the address to delete it.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($address->delete()) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json([
            'message' => 'An error occurred while deleting the address.',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
