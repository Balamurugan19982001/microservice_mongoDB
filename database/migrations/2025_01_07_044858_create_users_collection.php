<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    protected $connection = 'mongodb';

    public function up(): void
    {
       Schema::connection($this->connection)
        ->create('users', function (Blueprint $collection) {
            $collection->unique('email');
            $collection->index('name');
            $collection->timestamps();
            $collection->schema([
                'bsonType' => 'object',
                'required' => ['name', 'email', 'password'],
                'properties' => [
                    'name' => [
                        'bsonType' => 'string',
                        'description' => 'Name of the user - required string'
                    ],
                    'email' => [
                        'bsonType' => 'string',
                        'description' => 'Email of the user - required string'
                    ],
                    'password' => [
                        'bsonType' => 'string',
                        'description' => 'Password hash - required string'
                    ],
                    'email_verified_at' => [
                        'bsonType' => ['date', 'null'],
                        'description' => 'Email verification timestamp'
                    ],
                    'remember_token' => [
                        'bsonType' => ['string', 'null'],
                        'description' => 'Remember token for user'
                    ],
                    'created_at' => [
                        'bsonType' => 'date',
                        'description' => 'Creation timestamp'
                    ],
                    'updated_at' => [
                        'bsonType' => 'date',
                        'description' => 'Last update timestamp'
                    ]
                ]
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection($this->connection)->drop('users');
    }
};
