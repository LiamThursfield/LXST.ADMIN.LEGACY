<?php

use App\Interfaces\CRM\OrganisationUnitInterface;
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
        Schema::table('crm_form_submissions', function (Blueprint $table) {
            $table->boolean('is_spam')->default(false)->after('contact_id');
            $table->index('is_spam');
        });

        Schema::table('crm_contacts', function (Blueprint $table) {
            $table->boolean('is_spam')->default(false)->after('id');
            $table->index('is_spam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crm_form_submissions', function (Blueprint $table) {
            $table->dropIndex('crm_form_submissions_is_spam_index');
            $table->dropColumn('is_spam');
        });

        Schema::table('crm_contacts', function (Blueprint $table) {
            $table->dropIndex('crm_contacts_is_spam_index');
            $table->dropColumn('is_spam');
        });
    }
};
