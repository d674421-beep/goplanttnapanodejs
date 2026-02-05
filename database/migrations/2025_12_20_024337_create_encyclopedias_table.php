<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
	{
		Schema::create('encyclopedias', function (Blueprint $table) {
			$table->id();
			$table->foreignId('plant_id')->nullable()->constrained()->nullOnDelete();
			$table->string('title');
			$table->text('content');
			$table->string('image')->nullable();
			$table->timestamps();

		});

	}

	public function down(): void
	{
		Schema::table('encyclopedias', function (Blueprint $table) {
			$table->dropForeign(['created_by']);
			$table->dropColumn(['video_url', 'created_by']);
		});
	}

};
