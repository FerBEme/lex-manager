<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class EventTypeFactory extends Factory {
    public function definition(): array {
        $types = [
            [
                'event_code' => 'hearing',
                'name' => 'Audiencia',
                'description' => 'Audiencia judicial programada dentro de un expediente.'
            ],
            [
                'event_code' => 'meeting',
                'name' => 'Reunión',
                'description' => 'Reunión con cliente, abogado o tercero relacionado al caso.'
            ],
            [
                'event_code' => 'reminder',
                'name' => 'Recordatorio',
                'description' => 'Recordatorio de vencimiento, plazo o actividad pendiente.'
            ],
            [
                'event_code' => 'deadline',
                'name' => 'Vencimiento',
                'description' => 'Fecha límite para presentar documentos, escritos o recursos.'
            ],
            [
                'event_code' => 'visit',
                'name' => 'Visita',
                'description' => 'Visita a entidad pública, inmueble o cliente.'
            ],
        ];
        return fake()->randomElement($types);
    }
}