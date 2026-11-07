<?php

namespace Tests\Feature;

use App\Models\Alojamiento;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservaIndexAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_account_without_a_valid_role_cannot_view_reservations(): void
    {
        $user = $this->makeUser(null);

        $this->actingAs($user)
            ->get(route('reservas.index'))
            ->assertForbidden();
    }

    public function test_client_only_sees_their_own_reservations(): void
    {
        $owner = $this->makeUser(User::ROLE_OWNER);
        $client = $this->makeUser(User::ROLE_CLIENT);
        $otherClient = $this->makeUser(User::ROLE_CLIENT);
        $ownAccommodation = $this->makeAccommodation($owner, 'Reserva visible para el cliente');
        $otherAccommodation = $this->makeAccommodation($owner, 'Reserva ajena al cliente');

        $this->makeReservation($client, $ownAccommodation);
        $this->makeReservation($otherClient, $otherAccommodation);

        $this->actingAs($client)
            ->get(route('reservas.index'))
            ->assertOk()
            ->assertSee('Reserva visible para el cliente')
            ->assertDontSee('Reserva ajena al cliente');
    }

    public function test_owner_only_sees_reservations_for_their_accommodations(): void
    {
        $owner = $this->makeUser(User::ROLE_OWNER);
        $otherOwner = $this->makeUser(User::ROLE_OWNER);
        $client = $this->makeUser(User::ROLE_CLIENT);
        $ownAccommodation = $this->makeAccommodation($owner, 'Reserva del alojamiento propio');
        $otherAccommodation = $this->makeAccommodation($otherOwner, 'Reserva del alojamiento ajeno');

        $this->makeReservation($client, $ownAccommodation);
        $this->makeReservation($client, $otherAccommodation);

        $this->actingAs($owner)
            ->get(route('reservas.index'))
            ->assertOk()
            ->assertSee('Reserva del alojamiento propio')
            ->assertDontSee('Reserva del alojamiento ajeno');
    }

    public function test_administrator_can_view_reservations_across_owners_and_clients(): void
    {
        $admin = $this->makeUser(User::ROLE_ADMIN);
        $owner = $this->makeUser(User::ROLE_OWNER);
        $client = $this->makeUser(User::ROLE_CLIENT);
        $firstAccommodation = $this->makeAccommodation($owner, 'Reserva global uno');
        $secondAccommodation = $this->makeAccommodation($owner, 'Reserva global dos');

        $this->makeReservation($client, $firstAccommodation);
        $this->makeReservation($client, $secondAccommodation);

        $this->actingAs($admin)
            ->get(route('reservas.index'))
            ->assertOk()
            ->assertSee('Reserva global uno')
            ->assertSee('Reserva global dos');
    }

    private function makeUser(?string $role): User
    {
        $user = User::factory()->create();
        $user->forceFill(['role' => $role])->save();

        return $user;
    }

    private function makeAccommodation(User $owner, string $name): Alojamiento
    {
        return $owner->alojamientos()->create([
            'nombre' => $name,
            'descripcion' => 'Alojamiento para una prueba de autorización.',
            'tipo' => 'apartamento',
            'direccion' => 'Calle 1',
            'ciudad' => 'Bogotá',
            'precio_por_noche' => '150000.00',
            'capacidad' => 2,
            'estado' => 'disponible',
        ]);
    }

    private function makeReservation(User $client, Alojamiento $alojamiento): Reserva
    {
        return $client->reservas()->create([
            'alojamiento_id' => $alojamiento->id,
            'fecha_entrada' => '2026-12-01',
            'fecha_salida' => '2026-12-03',
            'cantidad_huespedes' => 2,
            'precio_total' => '300000.00',
            'estado' => 'pendiente',
        ]);
    }
}
