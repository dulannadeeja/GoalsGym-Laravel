<?php

namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Seeder;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassType::create(
            [
                'name' => 'Yoga',
                'description' => 'Yoga is a group of physical, mental, and spiritual practices or disciplines which originated in ancient India. Yoga is one of the six orthodox schools of Hindu philosophical traditions. There is a broad variety of yoga schools, practices, and goals in Hinduism, Buddhism, and Jainism.',
                'duration' => '60',
            ]
        );
        ClassType::create(
            [
                'name' => 'Pilates',
                'description' => 'Pilates is a physical fitness system developed in the early 20th century by Joseph Pilates, after whom it was named. Pilates called his method "Contrology". It is practiced worldwide, especially in Western countries such as Canada, the United States and the United Kingdom.',
                'duration' => '240',
            ]
        );
        ClassType::create(
            [
                'name' => 'Zumba',
                'description' => 'Zumba is an exercise fitness program created by Colombian dancer and choreographer Alberto "Beto" Pérez during the 1990s. Zumba is a trademark owned by Zumba Fitness, LLC. The Brazilian pop singer Claudia Leitte has become the international ambassador to Zumba Fitness.',
                'duration' => '40',
            ]
        );
        ClassType::create(
            [
                'name' => 'Boxing',
                'description' => 'Boxing is a combat sport in which two people, usually wearing protective gloves, throw punches at each other for a predetermined amount of time in a boxing ring.',
                'duration' => '180',
            ]
        );
        ClassType::create(
            [
                'name' => 'Cycling',
                'description' => 'Cycling, also called bicycling or biking, is the use of bicycles for transport, recreation, exercise or sport. People engaged in cycling are referred to as "cyclists", "bikers", or less commonly, as "bicyclists".',
                'duration' => '60',
            ]
        );
        ClassType::create(
            [
                'name' => 'Dance',
                'description' => 'Dance is a performing art form consisting of purposefully selected sequences of human movement. This movement has aesthetic and symbolic value, and is acknowledged as dance by performers and observers within a particular culture.',
                'duration' => '30',
            ]
        );
        ClassType::create(
            [
                'name' => 'Meditation',
                'description' => 'Meditation is a practice where an individual uses a technique – such as mindfulness, or focusing the mind on a particular object, thought, or activity – to train attention and awareness, and achieve a mentally clear and emotionally calm and stable state.',
                'duration' => '60',
            ]
        );
        ClassType::create(
            [
                'name' => 'Tai Chi',
                'description' => 'Tai chi, short for T\'ai chi ch\'üan or Tàijí quán, is an internal Chinese martial art practiced for defense training, health benefits, and meditation. The term taiji is a Chinese cosmological concept for the flux of yin and yang, and \'quan\' means fist.',
                'duration' => '60',
            ]
        );
        ClassType::create([
            'name' => 'Pump',
            'description' => 'Pump is a barbell workout for anyone looking to get lean, toned and fit – fast. Using light to moderate weights with lots of repetition, BODYPUMP gives you a total body workout. It will burn up to 540 calories. Instructors will coach you through the scientifically proven moves and techniques pumping out encouragement, motivation and great music – helping you achieve much more than on your own! You’ll leave the class feeling challenged and motivated, ready to come back for more.',
            'duration' => '60',
        ]);
        ClassType::create([
            'name' => 'Combat',
            'description' => 'Combat is a high-energy martial arts-inspired workout that is totally non-contact. Punch and kick your way to fitness and burn up to 740 calories in a class. No experience needed. Learn moves from Karate, Taekwondo, Boxing, Muay Thai, Capoeira and Kung Fu. Release stress, have a blast and feel like a champ. Bring your best fighter attitude and leave inhibitions at the door.',
            'duration' => '120',
        ]);
        ClassType::create([
            'name' => 'Balance',
            'description' => 'Balance is a class that delivers a workout with benefits you can feel. In just 55 minutes you’ll get stronger and fitter, gain better balance, move well and feel great. The moves are simple and low impact, which makes Balance ideal if you’re starting out, have aches and pains or haven’t exercised in a while. You’ll strengthen your entire body and leave the class feeling calm and centered. Happy.',
            'duration' => '45',
        ]);
        ClassType::create([
            'name' => 'Step',
            'description' => 'Step is a full-body cardio workout to really tone your butt and thighs. In a Step class you’ll climb and descend a height-adjustable step to fun, uplifting music. You’ll burn calories and shape your body. Step is for all ages and fitness levels. You can increase or decrease the step height and move at a pace that suits you. You’ll leave feeling challenged and motivated, ready to come back for more.',
            'duration' => '60',
        ]);
        ClassType::create([
            'name' => 'Core',
            'description' => 'Core is a 30-minute workout that strengthens everything from your shoulders to your hips. This class isn’t for the faint hearted. You’ll work with resistance tubes and weight plates, as well as body weight exercises like crunches, and hovers. You’ll leave the class feeling challenged and motivated, ready to come back for more.',
            'duration' => '30',
        ]);
    }
}
