<?php

use Illuminate\Database\Seeder;

class ApplicationTypesSeeds extends Seeder
{
    /**
     * All possible application's types.
     *
     * @var array
     */
    protected $types = [
        "Confirmation Letter",
        "Certification Letter",
        "Result Slip",
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->types as $type){
            \App\ApplicationType::create([
                "name" => $type,
                "slug" => str_slug($type)
            ]);
        }
    }
}
