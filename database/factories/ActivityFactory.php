<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        // 'activity_type_id' => $this->faker->name,
        'activity_no' => $this->faker->randomNumber(5, true),
        'activity_name' => $this->faker->lexify('活動名稱-??????????'),
        'apply_sdate' => $this->faker->datetime(),
        'apply_edate' => $this->faker->datetime(),
        'activity_sdate' => $this->faker->datetime(),
        'activity_edate' => $this->faker->datetime(),
        'act_place' => $this->faker->lexify('活動地點-??????????'),
        'act_content' => $this->faker->paragraph(),
        'apply_fee' => $this->faker->randomNumber(4, false),
        'identity' => $this->faker->randomElement([
            'member', 'guest'
        ]),
        'per_limit' => $this->faker->randomNumber(2, false),
        'host_unit' => $this->faker->lexify('主辦單位-?????'),
        'contact' => $this->faker->word(),
        'memo' => $this->faker->text(),
        ];
    }
}
