<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function callback()
    {

        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $orderId = $notification->order_id;

        $booking = Booking::findOrFail($orderId);

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $booking->payment_status = 'pending';
                } else {
                    $booking->payment_status = 'success';
                }
            }
        } elseif ($status == 'settlement') {
            $booking->payment_status = 'success';
        } elseif ($status == 'pending') {
            $booking->payment_status = 'pending';
        } elseif ($status == 'deny') {
            $booking->payment_status = 'cancelled';
        } elseif ($status == 'expire') {
            $booking->payment_status = 'cancelled';
        } elseif ($status == 'cancel') {
            $booking->payment_status = 'cancelled';
        }

        // Simpan transaksi
        $booking->save();

        // Return response
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notification Success'
            ]
        ]);
    }
}
