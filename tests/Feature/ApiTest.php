<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiTest extends TestCase
{

    /**
     * A basic api test.
     *
     * @return void
     */
    public function test_crud_from_articles_api()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // Création d'un article

        $post = $this->postJson('/articles', [
            'title' => 'test',
            'content' => 'test the content',
            'image' => 'image.png',
            'user_id' => 1,
            'lang_id' => 1
            ]);
        $post->assertStatus(201);
        $post->assertJson(fn (AssertableJson $json) =>
        $json->has('id')->etc()
        );

        // Création d'une variable $id afin de stocker l'id de l'article

        $id = $post->original->id;

        // Affichage de l'article

        $get = $this->getJson('/articles/'.$id);
        $get->assertStatus(200);
        $get->assertJson(fn (AssertableJson $json) =>
        $json->hasAll(['title', 'content', 'image', 'user_id', 'lang_id'])
            ->whereAllType([
                'title'=> 'string',
                'content' => 'string',
                'image' => 'string',
                'user_id' => 'integer',
                'lang_id' => 'integer'
            ])
            ->etc()
        );

        // Modification de l'article

        $put = $this->putJson('/articles/'.$id, [
            'title' => 'test put',
            'content' => 'test the content put',
            'image' => 'imageput.png',
            'user_id' => 2,
            'lang_id' => 2
        ]);
        $put->assertStatus(200);

        // Suppression de l'article

        $delete = $this->deleteJson('/articles/'.$id);
        $delete->assertStatus(200);

        // Vérification de la suppression

        $getAfterDelete = $this->getJson('/articles/'.$id);
        $getAfterDelete->assertStatus(404);
    }
}
