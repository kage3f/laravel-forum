<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $category = Category::where('slug', 'tecnologia')->first();

        if ($user && $category) {
            Topic::create([
                'title' => 'Como configurar o React Router v6 com TypeScript?',
                'content' => 'Estou tendo dificuldades com as novas APIs de data router. Alguém já implementou a função loader com tipagem estrita no novo padrão?',
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);
        }

        $categoryGeral = Category::where('slug', 'geral')->first();
        if ($user && $categoryGeral) {
            Topic::create([
                'title' => 'Bem-vindos ao novo fórum!',
                'content' => 'Este é o primeiro tópico do nosso novo fórum. Sintam-se à vontade para explorar e participar das discussões.',
                'user_id' => $user->id,
                'category_id' => $categoryGeral->id,
            ]);
        }
    }
}
