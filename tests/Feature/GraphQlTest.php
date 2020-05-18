<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GraphQlTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
   public function testQueriesPosts(): void
{
 $post = factory(Post::class)->create();

    $this->graphQL(/** @lang GraphQL */ '
    {
        posts {
            id
            title
        }
    }
    ')->assertJson([
        'data' => [
            'posts' => [
                [
                    'id' => $post->id,
                    'title' => $post->title,
                ]
            ]
        ]
    ]);
                }

public function testCreatePost(): void
{
    $response = $this->graphQL(/** @lang GraphQL */ '
        mutation CreatePost($title: String!) {
            createPost(title: $title) {
                id
            }
        }
    ', [
        'title' => 'Automatic testing proven to reduce stress levels in developers'
    ]);
}

public function testOrdersUsersByName(): void
{
    factory(User::class)->create(['name' => 'Oliver']);
    factory(User::class)->create(['name' => 'Chris']);
    factory(User::class)->create(['name' => 'Benedikt']);

    $response = $this->graphQL(/** @lang GraphQL */ '
    {
        users(orderBy: "name") {
            name
        }
    }
    ');

    $names = $response->json("data.*.name");

    $this->assertSame(
        [
            'Benedikt',
            'Chris',
            'Oliver',
        ],
        $names
    );
}

public function testUploadFile(): void
{
$this->multipartGraphQL(
    [
        'operations' => /** @lang JSON */
            '
            {
                "query": "mutation Upload($file: Upload!) { upload(file: $file) }",
                "variables": {
                    "file": null
                }
            }
        ',
        'map' => /** @lang JSON */
            '
            {
                "0": ["variables.file"]
            }
        ',
    ],
    [
        '0' => UploadedFile::fake()->create('image.jpg', 500),
    ]
)

}

public function testValidation(): void
{
    $this
    ->graphQL(/** @lang GraphQL */ '
    mutation {
        createUser(email: "invalid email")
    }
    ')
    ->assertGraphQLValidationKeys(['email']);

}



}
