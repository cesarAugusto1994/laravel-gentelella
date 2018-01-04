<?php

use Illuminate\Database\Seeder;
use App\Status;

class SituationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            "Disponivel",
            "Reservado",
            "Em uso",
            "Triagem",
            "Quebrado",
        ];

        foreach($statuses as $key => $status) {
            $status.$key = new Status();
            $status.$key->name = $status;
            $status.$key->save();
        }
       
    }
}
