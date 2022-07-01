<?php

namespace App\Database\Seeds;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\SubProduct;
use App\Models\User;
use App\Models\WeddingTime;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $weddingTimes  = (new WeddingTime())->findAll();
        $users         = (new User())->where('role', User::ROLE_USER)->findAll();
        $subProducts   = (new SubProduct())->findAll();
        $statuses      = [Booking::STATUS_WAITING_PAYMENT, Booking::STATUS_DOWN_PAYMENT, Booking::STATUS_PAID_OFF];
        $merchantBanks = ['BRI', 'BCA', 'Mandiri'];

        for ($i = 0; $i < 8; $i++) {
            $user       = $users[array_rand($users)];
            $subProduct = $subProducts[array_rand($subProducts)];

            $status = $statuses[array_rand($statuses)];

            $booking = [
                "user_id"          => $user['id'],
                "product_id"       => $subProduct['product_id'],
                "sub_product_id"   => $subProduct['id'],
                "name"             => $user['name'],
                "address"          => "Jln Raya Test",
                "phone"            => '08' . mt_rand(11111111, 99999999),
                "identity_card"    => mt_rand(11111111, 99999999),
                "wedding_date"     => Time::now()->addDays(round(rand(10, 30)))->toDateTimeString(),
                "wedding_time_id"  => $weddingTimes[array_rand($weddingTimes)]['id'],
                "pre_wedding_date" => Time::now()->addDays(round(rand(10, 30)))->toDateTimeString(),
                "payment_status"   => $status,
                "expired_at"       => Time::now()->subDays(2)->toDateTimeString(),
            ];

            $bookingId = (new Booking())->insert($booking);

            $payment = [
                "booking_id"            => $bookingId,
                "proof"                 => $this->str_random(30) . '.png',
                "sender_bank"           => $merchantBanks[array_rand($merchantBanks)],
                "sender_account_number" => mt_rand(11111111, 99999999),
                "sender_name"           => $user['name'],
                "merchant_bank"         => $merchantBanks[array_rand($merchantBanks)],
                "status"                => $status,
            ];

            (new Payment())->insert($payment);
        }
    }

    private function str_random($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
