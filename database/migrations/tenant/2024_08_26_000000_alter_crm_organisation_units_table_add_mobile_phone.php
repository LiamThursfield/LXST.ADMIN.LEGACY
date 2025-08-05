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
        Schema::table('crm_organisation_units', function (Blueprint $table) {
            $table->string('mobile_phone', OrganisationUnitInterface::FIELD_TELEPHONE_MAX_LENGTH)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crm_organisation_units', function (Blueprint $table) {
            $table->dropColumn('mobile_phone');
        });
    }
};
