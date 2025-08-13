<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::create([
            'title' => 'Jurassic Park',
            'year' => 1993,
            'category_id' => 1,
            'duration' => '2h7m',
            'synopsis' => "An industrialist invites some experts to visit his theme park of cloned dinosaurs. After a power failure, the creatures run loose, putting everyone's lives, including his grandchildren's, in danger.",
            'image' => '',
            'trailer_link' => 'https://www.youtube.com/watch?v=_jKEqDKpJLw'
        ]);
        Movie::create([
            'title' => 'Se7en',
            'year' => 1995,
            'category_id' => 2,
            'duration' => '2h7m',
            'synopsis' => "Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his motives.",
            'image' => '',
            'trailer_link' => 'https://www.youtube.com/watch?v=KPOuJGkpblk'
        ]);
        Movie::create([
            'title' => 'Raiders of the Lost Ark',
            'year' => 1981,
            'category_id' => 3,
            'duration' => '1h55m',
            'synopsis' => "In 1936, archaeologist Indiana Jones is tasked by Army Intelligence to help locate a legendary ancient power, the Ark of Covenant, before the Nazis get it first.",
            'image' => '',
            'trailer_link' => 'https://www.youtube.com/watch?v=0xQSIdSRlAk'
        ]);
        Movie::create([
            'title' => 'The Truman Show',
            'year' => 1998,
            'category_id' => 4,
            'duration' => '1h43m',
            'synopsis' => "An insurance salesman begins to suspect that his whole life is actually some sort of reality TV show.",
            'image' => '',
            'trailer_link' => 'https://www.youtube.com/watch?v=dlnmQbPGuls'
        ]);
        Movie::create([
            'title' => "Howl's Moving Castle",
            'year' => 2004,
            'category_id' => 5,
            'duration' => '1h59m',
            'synopsis' => "When an unconfident young woman is cursed with an old body by a spiteful witch, her only chance of breaking the spell lies with a self-indulgent yet insecure young wizard and his companions in his legged, walking castle.",
            'image' => '',
            'trailer_link' => 'https://www.youtube.com/watch?v=iwROgK94zcM'
        ]);
        Movie::create([
            'title' => "Dead Poets Society",
            'year' => 1989,
            'category_id' => 4,
            'duration' => '2h8m',
            'synopsis' => "Maverick teacher John Keating returns in 1959 to the prestigious New England boys' boarding school where he was once a star student, using poetry to embolden his pupils to new heights of self-expression.",
            'image' => '',
            'trailer_link' => 'https://www.youtube.com/watch?v=ye4KFyWu2do'
        ]);
        Movie::create([
            'title' => "Dune: Part One",
            'year' => 2021,
            'category_id' => 5,
            'duration' => '2h35m',
            'synopsis' => "Paul Atreides arrives on Arrakis after his father accepts the stewardship of the dangerous planet. However, chaos ensues after a betrayal as forces clash to control melange, a precious resource.",
            'image' => '',
            'trailer_link' => 'https://www.youtube.com/watch?v=n9xhJrPXop4'
        ]);
        Movie::create([
            'title' => "Eternal Sunshine of the Spotless Mind",
            'year' => 2004,
            'category_id' => 4,
            'duration' => '1h48m',
            'synopsis' => "When their relationship turns sour, a couple undergoes a medical procedure to have each other erased from their memories forever.",
            'image' => '',
            'trailer_link' => 'https://www.youtube.com/watch?v=07-QBnEkgXU'
        ]);
        Movie::create([
            'title' => "Shrek",
            'year' => 2001,
            'category_id' => 5,
            'duration' => '1h30m',
            'synopsis' => "A mean lord exiles fairytale creatures to the swamp of a grumpy ogre, who must go on a quest and rescue a princess for the lord in order to get his land back.",
            'image' => '',
            'trailer_link' => 'https://www.youtube.com/watch?v=CwXOrWvPBPk'
        ]);
        Movie::create([
            'title' => "Akira",
            'year' => 1988,
            'category_id' => 5,
            'duration' => '2h4m',
            'synopsis' => "A secret military project endangers Neo-Tokyo when it turns a teenage biker gang member into a rampaging psychic psychopath who can only be stopped by his best friend.",
            'image' => '',
            'trailer_link' => 'https://www.youtube.com/watch?v=vvnNpjH93NU'
        ]);
    }
}
