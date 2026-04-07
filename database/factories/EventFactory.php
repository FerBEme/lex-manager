<?php
namespace Database\Factories;

use App\Models\CaseFile;
use App\Models\Event;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Symfony\Component\Clock\now;

class EventFactory extends Factory {
    public function definition(): array {
        $start = $this->faker->dateTimeBetween('-1 month','+2 months');
        $end = (clone $start)->modify('+' . rand(1,3) . 'hours');
        $evenTypeId = EventType::all()->random()->id;
        $titles = [
            'Audiencia de conciliación',
            'Reunión con cliente',
            'Presentación de escrito',
            'Audiencia única',
            'Seguimiento de expediente',
            'Revisión de documentación',
            'Visita al juzgado',
            'Llamada con cliente',
        ];
        return [
            'title' => $this->faker->randomElement($titles),
            'description' => $this->faker->sentence(15),
            'start_datetime' => $start,
            'end_datetime' => $end,
            'meeting_link' => $this->faker->boolean(30) ? 'https://meet.google.com/' . $this->faker->lexify('???-????-???') : null,
            'event_type_id' => $evenTypeId,
            'case_file_id' => CaseFile::all()->random()->id,
            'created_by' => User::all()->random()->id,
            'created_at' => now(),
        ];
    }
}
