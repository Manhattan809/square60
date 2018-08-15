<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->text('bbl');
            $table->text('condominium_number');
            $table->text('address');
            $table->text('borough');
            $table->text('block');
            $table->text('lot');
            $table->text('zoning_district_1');
            $table->text('zoning_district_2');
            $table->text('zoning_district_3');
            $table->text('zoning_district_4');
            $table->text('zoning_map');
            $table->text('zoning_map_code');
            $table->text('commercial_overlay_1');
            $table->text('commercial_overlay_2');
            $table->text('zoning_map_url');
            $table->text('owner');
            $table->text('owner_type');
            $table->text('land_use');
            $table->text('lot_area');
            $table->text('lot_frontage');
            $table->text('lot_depth');
            $table->text('year_built');
            $table->text('year_altered_1');
            $table->text('year_altered_2');
            $table->text('historic_district_name');
            $table->text('landmark_name');
            $table->text('special_purpose_district_1');
            $table->text('special_purpose_district_2');
            $table->text('special_purpose_district_3');
            $table->text('building_class');
            $table->text('building_class_name');
            $table->text('number_of_buildings');
            $table->text('number_of_floors');
            $table->text('total_of_units');
            $table->text('residential_units');
            $table->text('community_district');
            $table->text('city_council_district');
            $table->text('school_district');
            $table->text('police_precinct');
            $table->text('fire_company');
            $table->text('sanitation_borough');
            $table->text('sanitation_district');
            $table->text('sanitation_subsection');
            $table->text('zip_code');
            $table->text('latitude');
            $table->text('longitude');
            $table->text('census_block');
            $table->text('census_tract_1');
            $table->text('census_tract_2');
            $table->text('health_center');
            $table->text('health_area');
            $table->text('limited_height_district');
            $table->text('split_boundary_indicator');
            $table->text('number_of_easements');
            $table->text('gross_floor_area');
            $table->text('commerical_area');
            $table->text('residential_area');
            $table->text('office_area');
            $table->text('retail_area');
            $table->text('garage_area');
            $table->text('storage_area');
            $table->text('factory_area');
            $table->text('other_area');
            $table->text('total_building_source_code');
            $table->text('building_frontage');
            $table->text('building_depth');
            $table->text('extension_code');
            $table->text('proximity_code');
            $table->text('irregular_lot_code');
            $table->text('lot_type');
            $table->text('basement_type_grade');
            $table->text('assessed_value_land');
            $table->text('assessed_value_total');
            $table->text('exempt_value_land');
            $table->text('exempt_value_total');
            $table->text('built_floor_area_ratio_far');
            $table->text('maximum_allowable_residential_far');
            $table->text('maximum_allowable_commercial_far');
            $table->text('maximum_allowable_facility_far');
            $table->text('boro_code');
            $table->text('x_coordinate');
            $table->text('y_coordinate');
            $table->text('sanborn_map');
            $table->text('tax_map');
            $table->text('e_designation_number');
            $table->text('apportionment_bbl');
            $table->text('apportionment_date');
            $table->text('pluto_map_id');
            $table->text('version_number');
            $table->text('shape_length');
            $table->text('shape_area');
            $table->text('building_info_url');
            $table->text('digital_tax_map_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
