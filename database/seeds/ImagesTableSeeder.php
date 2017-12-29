<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Image;


class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
              'name' => 'Partnership rationale',
              'image' => URL::asset('/images/image-1.jpg'),
              'created_at' => new \DateTime()
            ],
            [
              'name' => 'Partnership rationale',
              'image' => URL::asset('/images/image-2.jpg'),
              'created_at' => new \DateTime()
            ],
            [
              'name' => 'Who we are',
              'image' => URL::asset('/images/image-3.jpg'),
              'created_at' => new \DateTime()
            ],
            [
              'name' => 'Our clients',
              'image' => URL::asset('/images/image-4.jpg'),
              'created_at' => new \DateTime()
            ],
            [
              'name' => 'The opportunity',
              'image' => URL::asset('/images/image-5.jpg'),
              'created_at' => new \DateTime()
            ]
        ]);
    }
}
