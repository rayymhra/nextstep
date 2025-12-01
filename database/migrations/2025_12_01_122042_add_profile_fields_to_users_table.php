<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_profile_fields_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('role');
            $table->string('phone')->nullable()->after('bio');
            $table->string('location')->nullable()->after('phone');
            $table->string('linkedin_url')->nullable()->after('location');
            $table->string('github_url')->nullable()->after('linkedin_url');
            $table->string('website_url')->nullable()->after('github_url');
            $table->string('profile_photo_path')->nullable()->after('website_url');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio', 
                'phone', 
                'location', 
                'linkedin_url', 
                'github_url', 
                'website_url',
                'profile_photo_path'
            ]);
        });
    }
};