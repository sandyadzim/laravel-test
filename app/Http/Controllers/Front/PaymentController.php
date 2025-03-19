<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with(['item.brand', 'item.type'])->findOrFail($bookingId);

        return view('front.payment', compact('booking'));
    }

    public function detail(Request $request, $bookingId) {}

    public function update(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->payment_method = 'midtrans';

        // Call Midtrans API
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        // Create Midtrans Params
        $midtransParams = [
            'transaction_details' => [
                'order_id' => $booking->id,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->customer_name,
                'email' => $booking->customer_email,
            ],
        ];

        // Get Snap Payment Page URL
        $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

        // Save payment URL to booking
        $booking->payment_url = $paymentUrl;
        $booking->save();

        // Redirect to Snap Payment Page
        return redirect($paymentUrl);
    }

    public function success(Request $request)
    {
        return view('front.success');
    }
}
