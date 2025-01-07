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
            ->create('tasks', function (Blueprint $collection) {
                $collection->index('user_id');
                $collection->index('title');
                $collection->timestamps();

                // Define schema validation rules for MongoDB
                $collection->schema([
                    'bsonType' => 'object',
                    'required' => ['title', 'content', 'user_id'],
                    'properties' => [
                        'title' => [
                            'bsonType' => 'string',
                            'description' => 'Title of the post - required string'
                        ],
                        'content' => [
                            'bsonType' => 'string',
                            'description' => 'Content of the post - required string'
                        ],
                        'user_id' => [
                            'bsonType' => 'objectId',
                            'description' => 'User ID reference - required ObjectId'
                        ],
                        'status' => [
                            'enum' => ['draft', 'published', 'archived'],
                            'description' => 'Status of the post'
                        ],
                        'tags' => [
                            'bsonType' => ['array', 'null'],
                            'items' => [
                                'bsonType' => 'string'
                            ],
                            'description' => 'Array of tag strings'
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
        Schema::connection($this->connection)->drop('tasks');
    }
};
