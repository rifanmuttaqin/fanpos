<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fanpos:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Proses Instalasi FANPOS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('--------------- Instalasi FANPOS ----------------');

        $this->line('Menghapus Database FANPOS Lama.');

        //Command,[Param]
        Artisan::call('database:delete', ['db_name' => env('DB_DATABASE')]);

        $this->line('Membuat Database FANPOS');
        Artisan::call('database:create', ['db_name' => env('DB_DATABASE')]);

        $this->line('Menjalankan Migrasi Database (Fresh Install).');
        Artisan::call('database:migrate:fresh');

        $this->line('Menyuntikan User Ke Database.');
        Artisan::call('database:user:seed');

        $this->line('Menyuntikan Role Ke Database.');
        $this->line('Butuh beberapa saat mohon bersabar......');
        Artisan::call('role:role:seed');

        $this->line('Menyuntikan Data Toko Sementara.');
        Artisan::call('database:toko:seed');

        $this->line('Instalasi telah selesai, Selamat Menggunakan FANPOS.');
    }
}
