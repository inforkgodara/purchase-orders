<?php

use Illuminate\Database\Seeder;
use App\Country;
use App\Province;
use App\City;
use App\Branch;
use App\PartyCategoryType;
use App\PartyCategory;
use App\PaymentTerm;
use App\LocationType;
use App\Location;
use App\ItemGroup;
use App\ItemCategory;
use App\ItemUnit;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = Country::create([
            'country' => 'INDIA'
        ]);

        $province = Province::create([
            'country_id' => $country->id,
            'province' => 'RAJASTHAN'
        ]);

        $city = City::create([
            'province_id' => $province->id,
            'country_id' => $country->id,
            'city' => 'JODHPUR'
        ]);

        $branchA = Branch::create([
            'city_id' => $city->id,
            'branch' => 'BRANCH A',
            'building' => 'FLOT NO 123, STREET NO 123',
            'street' => 'NEAR BY XYZ BUILDING, DIST XYZ',
            'phone_number' => '9001635942',
            'email' => 'ADMIN@BRANCHA.COM'
        ]);

        $branchB = Branch::create([
            'city_id' => $city->id,
            'branch' => 'BRANCH B',
            'building' => 'FLOT NO 123, STREET NO 123',
            'street' => 'NEAR BY XYZ BUILDING, DIST XYZ',
            'phone_number' => '9001635942',
            'email' => 'ADMIN@BRANCHB.COM'
        ]);

        /* =============================================  */

        $partyCategoryTypeDebtor = PartyCategoryType::create([
            'type' => 'DEBTOR'
        ]);

        $partyCategoryTypeCreditor = PartyCategoryType::create([
            'type' => 'CREDITOR'
        ]);

        PartyCategory::create([
            'party_category_type_id' => $partyCategoryTypeCreditor->id,
            'category' => 'SERVICE PROVIDER'
        ]);

        PartyCategory::create([
            'party_category_type_id' => $partyCategoryTypeCreditor->id,
            'category' => 'TRANSPORTER'
        ]);

        PartyCategory::create([
            'party_category_type_id' => $partyCategoryTypeCreditor->id,
            'category' => 'IMPORTING COMPANY'
        ]);

        PartyCategory::create([
            'party_category_type_id' => $partyCategoryTypeCreditor->id,
            'category' => 'CARRIER'
        ]);

        PartyCategory::create([
            'party_category_type_id' => $partyCategoryTypeCreditor->id,
            'category' => 'CLEARING AGENT'
        ]);

        PartyCategory::create([
            'party_category_type_id' => $partyCategoryTypeCreditor->id,
            'category' => 'INSURANCE'
        ]);

        PartyCategory::create([
            'party_category_type_id' => $partyCategoryTypeCreditor->id,
            'category' => 'CREDITOR'
        ]);

        PartyCategory::create([
            'party_category_type_id' => $partyCategoryTypeDebtor->id,
            'category' => 'SUPER MARKET'
        ]);

        PartyCategory::create([
            'party_category_type_id' => $partyCategoryTypeDebtor->id,
            'category' => 'RETAIL'
        ]);

        PaymentTerm::create([
            'term' => 'GUARANTEE'
        ]);

        PaymentTerm::create([
            'term' => 'ADVANCE'
        ]);

        PaymentTerm::create([
            'term' => '90 DAYS AFTER BILL'
        ]);

        PaymentTerm::create([
            'term' => 'IMMEDIATE'
        ]);

        /* ================================================= */
        
        $damageLocation = LocationType::create([
            'type' => 'DAMAGE'
        ]);

        LocationType::create([
            'type' => 'DIRECT'
        ]);

        LocationType::create([
            'type' => 'GIT'
        ]);

        $shopLocation = LocationType::create([
            'type' => 'SHOP'
        ]);

        $warehouseLocation = LocationType::create([
            'type' => 'WAREHOUSE'
        ]);

        Location::create([
            'branch_id' => $branchA->id,
            'location_type_id' => $warehouseLocation->id,
            'name' => 'CORPORATE',
            'building' => 'ABC ROAD, NEAR BY XYZ BUILDING',
            'street' => 'IN 203 STREET',
            'city_id' => $city->id,
        ]);

        Location::create([
            'branch_id' => $branchA->id,
            'location_type_id' => $shopLocation->id,
            'name' => 'DEPO 01',
            'building' => 'ABC ROAD, NEAR BY XYZ BUILDING',
            'street' => 'IN 203 STREET',
            'city_id' => $city->id,
        ]);

        Location::create([
            'branch_id' => $branchA->id,
            'location_type_id' => $shopLocation->id,
            'name' => 'DEPO 02',
            'building' => 'ABC ROAD, NEAR BY XYZ BUILDING',
            'street' => 'IN 203 STREET',
            'city_id' => $city->id,
        ]);
        
        /* ========================================== */

        ItemGroup::create([
            'group' => 'GROUP A'
        ]);

        ItemGroup::create([
            'group' => 'GROUP B'
        ]);

        ItemCategory::create([
            'category' => 'CATEGORY A'
        ]);

        ItemCategory::create([
            'category' => 'CATEGORY B'
        ]);

        ItemUnit::create([
            'unit' => 'UNIT A'
        ]);

        ItemUnit::create([
            'unit' => 'UNIT B'
        ]);
    }
}
