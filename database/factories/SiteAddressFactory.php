<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteAddress>
 */
class SiteAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countryCodes = ['+20', '+966', '+971', '+1'];
        $code1 = $this->faker->randomElement($countryCodes);
        $code2 = $this->faker->randomElement($countryCodes);

        return [
            'title_ar' => $this->faker->company.' العربية',
            'title_en' => $this->faker->company,
            'address_ar' => $this->faker->address.' العربية',
            'address_en' => $this->faker->address,
            'email' => $this->faker->safeEmail,
            'phone' => $code1.$this->faker->numerify('##########'),
            'phone2' => $code2.$this->faker->numerify('##########'),
            'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3452.5221691591773!2d31.330127787486845!3d30.079228310203483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583e176f99d6a5%3A0x92096e6818b66f6a!2s25%20Asmaa%20Fahmi%2C%20Al%20Golf%2C%20Heliopolis%2C%20Cairo%20Governorate%204451333!5e0!3m2!1sen!2seg!4v1745182621605!5m2!1sen!2seg',
            'order' => $this->faker->numberBetween(1, 100),
            'status' => true,
        ];
    }
}
