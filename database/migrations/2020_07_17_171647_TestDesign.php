<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TestDesign extends Migration
{

    // Creation of the Tables for the Test and Insertion of records in the table
    public function up()
    {

        // Table : State
        Schema::create('States', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description',20)->notNullable();
            $table->timestamps();
        });

        DB::table('States')->insert([
            ['description' => 'Activo'],
            ['description' => 'Inactivo'],
            ]);

        // End Table : State

        // Table : Products

        Schema::create('Products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description',50)->notNullable();
            $table->string('link_image',50)->notNullable()->default('https://picsum.photos/100/100?random');
            $table->unsignedInteger('state_id')->notNullable()->default(1);
            $table->foreign('state_id')->references('id')->on('States');
            $table->timestamps();
        });

        DB::table('Products')->insert([
            ['description' => 'Ceviche Clasico' , 'link_image' => 'https://picsum.photos/110/110?random'],
            ['description' => 'Ceviche Mixto'  , 'link_image' => 'https://picsum.photos/142/145?random'],
            ['description' => 'Seco de Pollo'  , 'link_image' => 'https://picsum.photos/143/144?random'],
            ['description' => 'Chicharron Mixto'  , 'link_image' => 'https://picsum.photos/147/165?random'],
            ['description' => 'Aji de Gallina'  , 'link_image' => 'https://picsum.photos/142/148?random'],
            ['description' => 'Arroz con Mariscos'  , 'link_image' => 'https://picsum.photos/109/125?random'],
            ['description' => 'Cabrito'  , 'link_image' => 'https://picsum.photos/113/112?random'],
            ['description' => 'Arroz con Pato'  , 'link_image' => 'https://picsum.photos/200/180?random'],
            ['description' => 'Carapulcra'  , 'link_image' => 'https://picsum.photos/125/115?random'],
            ['description' => 'Lengua Guisada' , 'link_image' => 'https://picsum.photos/135/145?random'],
            ]);

        // End Table : Products

        // End Table : Products

        // Table : State Orders
        Schema::create('stateorders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description',20)->notNullable();
            $table->timestamps();
        });

        DB::table('stateorders')->insert([
            ['description' => 'Solicitado'],
            ['description' => 'Atendido'],
            ['description' => 'Rechazado'],
            ]);

        // End Table : State



        // Table : Orders

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('order_date');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('state_id')->default(1);
            $table->timestamps();
        });

        Schema::create('orders_detail', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->notNullable();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedInteger('product_id')->notNullable();
            $table->foreign('product_id')->references('id')->on('Products');
            $table->unsignedInteger('quantity')->notNullable()->default(0);
            $table->timestamps();
            $table->primary(Array('order_id', 'product_id'));
        });


        // Test Users --- Example
        DB::table('users')->insert([
            'name'  => 'testbrandfood',
            'email' => 'testbrandfood@brandfood.com',
            'password' => bcrypt('testbrandfood'),
        ]);

    }

    public function down()
    {
        //
    }
}
