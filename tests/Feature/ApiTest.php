<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic api test.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response_on_api_call()
    {
        $response = $this->getJson('/articles/1');
        $response->assertStatus(200);
    }

    /**
     * A basic api test.
     *
     * @return void
     */
    public function test_the_application_returns_a_valid_data_format_for_an_article_api_call()
    {
        $response = $this->getJson('/articles/1');
        $response->assertJson(fn (AssertableJson $json) =>
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
    }
}
