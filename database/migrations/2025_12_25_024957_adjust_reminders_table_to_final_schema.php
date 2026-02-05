<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
	{
		Schema::table('reminders', function (Blueprint $table) {

			// rename kolom lama → baru
			$table->renameColumn('judul', 'title');
			$table->renameColumn('waktu', 'remind_at');
			$table->renameColumn('email_terkirim', 'email_sent');

			// tambah kolom baru
			$table->text('description')->nullable()->after('title');
		});
	}

	public function down()
	{
		Schema::table('reminders', function (Blueprint $table) {

			$table->renameColumn('title', 'judul');
			$table->renameColumn('remind_at', 'waktu');
			$table->renameColumn('email_sent', 'email_terkirim');

			$table->dropColumn('description');
		});
	}

};
