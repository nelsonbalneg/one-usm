<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VirtualMap;

class VirtualMapSeeder extends Seeder
{
    public function run(): void
    {
        $markers = [
            [
                'latitude' => 7.121676,
                'longitude' => 124.830464,
                'label' => "CSM",
                'url' => "http://localhost/virtual/csm/index.htm",
                'text' => "College of Science and Mathematics"
            ],
            [
                'latitude' => 7.122701,
                'longitude' => 124.831288,
                'label' => "CASS",
                'url' => "http://localhost/virtual/cass/index.htm",
                'text' => "College of Arts and Social Sciences"
            ],
            [
                'latitude' => 7.122589,
                'longitude' => 124.830578,
                'label' => "USM Hospital",
                'url' => "http://localhost/virtual/hospital/index.htm",
                'text' => "University Hospital"
            ],
            [
                'latitude' => 7.116203,
                'longitude' => 124.831575,
                'label' => "CBDEM",
                'url' => "http://localhost/virtual/index.htm",
                'text' => "College of Business, Development Economics and Management"
            ],
            [
                'latitude' => 7.113014,
                'longitude' => 124.830906,
                'label' => "Alumni House",
                'url' => "http://localhost/virtual/alumni/index.htm",
                'text' => "Alumni House"
            ],
            [
                'latitude' => 7.112038,
                'longitude' => 124.831456,
                'label' => "Administration Building",
                'url' => "http://localhost/virtual/admin/index.htm",
                'text' => "Administration Building"
            ],
            [
                'latitude' => 7.11270535718375,
                'longitude' => 124.83017608163115,
                'label' => "USM Comm. Building",
                'url' => "http://localhost/virtual/admin/index.htm",
                'text' => "USM Commercial Building"
            ],
            [
                'latitude' => 7.113303729330942,
                'longitude' => 124.83100328475732,
                'label' => "Faculty House",
                'url' => "http://localhost/virtual/index.htm",
                'text' => "USM Faculty Association"
            ],
            [
                'latitude' => 7.113164458341588,
                'longitude' => 124.8333952587667,
                'label' => "CA",
                'url' => "http://localhost/virtual/index.htm",
                'text' => "College of Agriculture"
            ],
            [
                'latitude' => 7.121105782558591,
                'longitude' => 124.83084715502669,
                'label' => "CHS",
                'url' => "http://localhost/virtual/index.htm",
                'text' => "College of Health Sciences"
            ],
            [
                'latitude' => 7.115488744659152,
                'longitude' => 124.83144958085687,
                'label' => "UICTO",
                'url' => "http://localhost/virtual/2/index.htm",
                'text' => "University Information and Communucation Technology Office"
            ],
            [
                'latitude' => 7.111813,
                'longitude' => 124.830377,
                'label' => "USM Welcome",
                'url' => "http://localhost/virtual/welcome/index.htm",
                'text' => "USM Welcome"
            ],
        ];

        foreach ($markers as $marker) {
            VirtualMap::create(array_merge($marker, [
                'campus_id' => 1, // set your campus_id
                'tenant_id' => 1, // set your tenant_id
            ]));
        }
    }
}
