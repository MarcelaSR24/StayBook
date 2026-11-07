<?php

namespace Tests\Feature;

use App\Models\Alojamiento;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAndReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_always_creates_a_client_even_if_an_admin_role_is_submitted(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Cliente de prueba',
            'email' => 'client@example.test',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => User::ROLE_ADMIN,
        ]);

        $response->assertRedirectToRoute('dashboard');
        $this->assertDatabaseHas('users', ['email' => 'client@example.test', 'role' => User::ROLE_CLIENT]);
    }

    public function test_client_cannot_manage_an_accommodation(): void
    {
        $client = $this->makeUser(User::ROLE_CLIENT);

        $this->actingAs($client)
            ->get(route('alojamientos.create'))
            ->assertForbidden();
    }

    public function test_owner_cannot_edit_another_owners_accommodation(): void
    {
        $owner = $this->makeUser(User::ROLE_OWNER);
        $otherOwner = $this->makeUser(User::ROLE_OWNER);
        $alojamiento = $this->makeAccommodation($otherOwner);

        $this->actingAs($owner)
            ->get(route('alojamientos.edit', $alojamiento))
            ->assertForbidden();
    }

    public function test_client_can_reserve_with_a_server_calculated_total(): void
    {
        $this->travelTo('2026-01-10 09:00:00');
        $owner = $this->makeUser(User::ROLE_OWNER);
        $client = $this->makeUser(User::ROLE_CLIENT);
        $alojamiento = $this->makeAccommodation($owner);

        $response = $this->actingAs($client)->post(route('reservas.store'), [
            'alojamiento_id' => $alojamiento->id,
            'fecha_entrada' => '2026-01-15',
            'fecha_salida' => '2026-01-18',
            'cantidad_huespedes' => 2,
            'precio_total' => '1.00',
        ]);

        $response->assertRedirectToRoute('reservas.index');
        $this->assertDatabaseHas('reservas', [
            'user_id' => $client->id,
            'alojamiento_id' => $alojamiento->id,
            'precio_total' => '450000.00',
            'estado' => 'pendiente',
        ]);
    }

    public function test_reservation_rejects_a_guest_count_above_capacity(): void
    {
        $this->travelTo('2026-01-10 09:00:00');
        $owner = $this->makeUser(User::ROLE_OWNER);
        $client = $this->makeUser(User::ROLE_CLIENT);
        $alojamiento = $this->makeAccommodation($owner);

        $response = $this->actingAs($client)->from(route('reservas.create'))->post(route('reservas.store'), [
            'alojamiento_id' => $alojamiento->id,
            'fecha_entrada' => '2026-01-15',
            'fecha_salida' => '2026-01-18',
            'cantidad_huespedes' => 3,
        ]);

        $response->assertRedirect(route('reservas.create'));
        $response->assertSessionHasErrors('cantidad_huespedes');
        $this->assertDatabaseCount('reservas', 0);
    }

    public function test_overlapping_pending_reservation_is_rejected(): void
    {
        $this->travelTo('2026-01-10 09:00:00');
        $owner = $this->makeUser(User::ROLE_OWNER);
        $firstClient = $this->makeUser(User::ROLE_CLIENT);
        $secondClient = $this->makeUser(User::ROLE_CLIENT);
        $alojamiento = $this->makeAccommodation($owner);
        $firstClient->reservas()->create([
            'alojamiento_id' => $alojamiento->id,
            'fecha_entrada' => '2026-01-15',
            'fecha_salida' => '2026-01-18',
            'cantidad_huespedes' => 2,
            'precio_total' => '450000.00',
            'estado' => 'pendiente',
        ]);

        $response = $this->actingAs($secondClient)->from(route('reservas.create'))->post(route('reservas.store'), [
            'alojamiento_id' => $alojamiento->id,
            'fecha_entrada' => '2026-01-17',
            'fecha_salida' => '2026-01-20',
            'cantidad_huespedes' => 2,
        ]);

        $response->assertRedirect(route('reservas.create'));
        $response->assertSessionHasErrors('fecha_entrada');
        $this->assertDatabaseCount('reservas', 1);
    }

    public function test_cancelled_reservation_releases_its_dates(): void
    {
        $this->travelTo('2026-01-10 09:00:00');
        $owner = $this->makeUser(User::ROLE_OWNER);
        $firstClient = $this->makeUser(User::ROLE_CLIENT);
        $secondClient = $this->makeUser(User::ROLE_CLIENT);
        $alojamiento = $this->makeAccommodation($owner);
        $reserva = $firstClient->reservas()->create([
            'alojamiento_id' => $alojamiento->id,
            'fecha_entrada' => '2026-01-15',
            'fecha_salida' => '2026-01-18',
            'cantidad_huespedes' => 2,
            'precio_total' => '450000.00',
            'estado' => 'pendiente',
        ]);

        $this->actingAs($firstClient)->patch(route('reservas.cancel', $reserva))->assertRedirectToRoute('reservas.index');
        $this->actingAs($secondClient)->post(route('reservas.store'), [
            'alojamiento_id' => $alojamiento->id,
            'fecha_entrada' => '2026-01-15',
            'fecha_salida' => '2026-01-18',
            'cantidad_huespedes' => 2,
        ])->assertRedirectToRoute('reservas.index');

        $this->assertDatabaseCount('reservas', 2);
        $this->assertDatabaseHas('reservas', ['id' => $reserva->id, 'estado' => 'cancelada']);
    }

    public function test_client_cannot_view_another_clients_reservation(): void
    {
        $owner = $this->makeUser(User::ROLE_OWNER);
        $client = $this->makeUser(User::ROLE_CLIENT);
        $otherClient = $this->makeUser(User::ROLE_CLIENT);
        $alojamiento = $this->makeAccommodation($owner);
        $reserva = $otherClient->reservas()->create([
            'alojamiento_id' => $alojamiento->id,
            'fecha_entrada' => '2026-03-01',
            'fecha_salida' => '2026-03-03',
            'cantidad_huespedes' => 2,
            'precio_total' => '300000.00',
            'estado' => 'pendiente',
        ]);

        $this->actingAs($client)->get(route('reservas.show', $reserva))->assertForbidden();
    }

    public function test_owner_can_confirm_only_reservations_for_their_own_accommodations(): void
    {
        $owner = $this->makeUser(User::ROLE_OWNER);
        $otherOwner = $this->makeUser(User::ROLE_OWNER);
        $client = $this->makeUser(User::ROLE_CLIENT);
        $ownReservation = $client->reservas()->create($this->reservationData($this->makeAccommodation($owner)));
        $otherReservation = $client->reservas()->create($this->reservationData($this->makeAccommodation($otherOwner)));

        $this->actingAs($owner)->patch(route('reservas.confirm', $ownReservation))
            ->assertRedirectToRoute('reservas.index');
        $this->patch(route('reservas.confirm', $otherReservation))->assertForbidden();

        $this->assertDatabaseHas('reservas', ['id' => $ownReservation->id, 'estado' => 'confirmada']);
        $this->assertDatabaseHas('reservas', ['id' => $otherReservation->id, 'estado' => 'pendiente']);
    }

    public function test_archiving_an_accommodation_or_account_preserves_reservation_history(): void
    {
        $owner = $this->makeUser(User::ROLE_OWNER);
        $client = $this->makeUser(User::ROLE_CLIENT);
        $alojamiento = $this->makeAccommodation($owner);
        $reserva = $client->reservas()->create($this->reservationData($alojamiento));

        $alojamiento->delete();
        $owner->delete();
        $client->delete();

        $this->assertDatabaseCount('reservas', 1);
        $this->assertTrue($reserva->fresh()->alojamiento->trashed());
        $this->assertTrue($reserva->fresh()->usuario->trashed());
    }

    public function test_administrator_cannot_change_their_own_role_from_the_user_screen(): void
    {
        $administrator = $this->makeUser(User::ROLE_ADMIN);

        $this->actingAs($administrator)
            ->patch(route('admin.users.role', $administrator), ['role' => User::ROLE_CLIENT])
            ->assertSessionHasErrors('role');

        $this->assertDatabaseHas('users', ['id' => $administrator->id, 'role' => User::ROLE_ADMIN]);
    }

    public function test_owner_cannot_be_downgraded_while_they_have_active_accommodations(): void
    {
        $administrator = $this->makeUser(User::ROLE_ADMIN);
        $owner = $this->makeUser(User::ROLE_OWNER);
        $this->makeAccommodation($owner);

        $this->actingAs($administrator)
            ->patch(route('admin.users.role', $owner), ['role' => User::ROLE_CLIENT])
            ->assertSessionHasErrors('role');

        $this->assertDatabaseHas('users', ['id' => $owner->id, 'role' => User::ROLE_OWNER]);
    }

    private function makeUser(string $role): User
    {
        $user = User::factory()->create();
        $user->forceFill(['role' => $role])->save();

        return $user;
    }

    private function makeAccommodation(User $owner): Alojamiento
    {
        return $owner->alojamientos()->create([
            'nombre' => 'Alojamiento de prueba',
            'descripcion' => 'Prueba funcional',
            'tipo' => 'apartamento',
            'direccion' => 'Calle 1',
            'ciudad' => 'Bogotá',
            'precio_por_noche' => '150000.00',
            'capacidad' => 2,
            'estado' => 'disponible',
        ]);
    }

    private function reservationData(Alojamiento $alojamiento): array
    {
        return [
            'alojamiento_id' => $alojamiento->id,
            'fecha_entrada' => '2026-03-01',
            'fecha_salida' => '2026-03-03',
            'cantidad_huespedes' => 2,
            'precio_total' => '300000.00',
            'estado' => 'pendiente',
        ];
    }
}
