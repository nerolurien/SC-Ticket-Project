<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ticket;
class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::first();

        if (!$user) {
            // Buat user demo jika belum ada
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => bcrypt('password'),
            ]);
        }

         $tickets = [
            [
                'title' => 'Error saat upload file lebih dari 2MB',
                'description' => 'Ketika mencoba upload file attachment dengan ukuran lebih dari 2MB, muncul pesan error "File too large". Apakah bisa ditingkatkan limitnya menjadi 10MB?',
                'status' => 'open',
                'priority' => 'medium',
            ],
            [
                'title' => 'Request: Dark mode',
                'description' => 'Apakah bisa ditambahkan opsi dark mode untuk website? Akan sangat membantu saat bekerja di malam hari agar tidak terlalu silau.',
                'status' => 'open',
                'priority' => 'low',
            ],
            [
                'title' => 'Bug: Notifikasi email tidak terkirim',
                'description' => 'Setelah membuat tiket baru, seharusnya ada notifikasi email yang dikirim ke admin. Tapi sepertinya email tidak terkirim. Sudah cek folder spam tapi tidak ada.',
                'status' => 'in_progress',
                'priority' => 'high',
            ],
        ];

        foreach ($tickets as $ticketData) {
            Ticket::create([
                'user_id' => $user->id,
                ...$ticketData,
            ]);
        }

        $this->command->info('Created ' . count($tickets) . ' sample tickets!');
    }

}
