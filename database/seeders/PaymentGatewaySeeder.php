<?php

namespace Database\Seeders;

use App\Models\Paymentgateways;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Paymentgateways::create([
            'name' => 'cash_on_delivery',
            'code' => 'cod'
        ]);
        Paymentgateways::create([
            'name' => 'khalti',
            'code' => 'khalti'
        ]);
    }
}