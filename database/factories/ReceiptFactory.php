<?php
namespace Database\Factories;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Receipt;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Symfony\Component\Clock\now;

class ReceiptFactory extends Factory {
    public function definition(): array {
        $receiptNumber = 'REC-' . now()->format('Y') . '-' . $this->faker->unique()->numerify('######');
        return [
            'receipt_number' => $receiptNumber,
            'file_path' => 'receipts/' . fake()->uuid() . '.pdf',
            'payment_id' => Payment::all()->random()->id,
            'customer_id' => Customer::all()->random()->id,
            'created_at' => fake()->dateTimeBetween('-1 year','now'),
        ];
    }
}
