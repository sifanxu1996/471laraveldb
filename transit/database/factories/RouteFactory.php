<?php

use Faker\Generator as Faker;

$factory->define(App\Route::class, function (Faker $faker) {
    return [

    ];
});

        Schema::create('routes', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('name');
            $table->integer('start_stop_id');
            $table->integer('end_stop_id');
            $table->timestamps();
        });

<?php