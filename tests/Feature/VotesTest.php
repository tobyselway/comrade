<?php

namespace Tests\Feature;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\VoteCollection;
use App\Post;
use App\User;
use App\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VotesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_upvote_a_post()
    {
        $this->actingAs($user = factory(User::class)->create(), 'api');
        $post = factory(Post::class)->create(['id' => 42]);

        $response = $this->post('/api/posts/' . $post->id . '/vote', [
            'score' => 1
        ])->assertStatus(200);

        $this->assertCount(1, $user->votedPosts);
        $response->assertJson([
            'data' => [
                'type' => 'posts',
                'post_id' => $post->id,
                'attributes' => [
                    'score' => 1,
                    'user_voted' => 1,
                    'votes' => [
                        'data' => [
                            [
                                'data' => [
                                    'type' => 'votes',
                                    'vote_id' => 1,
                                    'attributes' => [
                                        'score' => 1
                                    ]
                                ],
                                'links' => [
                                    'self' => url('/posts/42')
                                ]
                            ]
                        ],
                        'links' => [
                            'self' => url('/posts')
                        ]
                    ]
                ]
            ],
            'links' => [
                'self' => url('/posts/' . $post->id)
            ]
        ]);

    }

    /** @test */
    public function a_user_can_downvote_a_post()
    {
        $this->actingAs($user = factory(User::class)->create(), 'api');
        $post = factory(Post::class)->create(['id' => 42]);

        $response = $this->post('/api/posts/' . $post->id . '/vote', [
            'score' => -1
        ])->assertStatus(200);

        $this->assertCount(1, $user->votedPosts);
        $response->assertJson([
            'data' => [
                'type' => 'posts',
                'post_id' => $post->id,
                'attributes' => [
                    'score' => -1,
                    'user_voted' => -1,
                    'votes' => [
                        'data' => [
                            [
                                'data' => [
                                    'type' => 'votes',
                                    'vote_id' => 1,
                                    'attributes' => [
                                        'score' => -1
                                    ]
                                ],
                                'links' => [
                                    'self' => url('/posts/42')
                                ]
                            ]
                        ],
                        'links' => [
                            'self' => url('/posts')
                        ]
                    ]
                ]
            ],
            'links' => [
                'self' => url('/posts/' . $post->id)
            ]
        ]);

    }

    /** @test */
    public function posts_are_returned_with_votes()
    {
        $this->actingAs($user = factory(User::class)->create(), 'api');
        $post = factory(Post::class)->create(['id' => 42, 'user_id' => $user->id]);

        $this->post('/api/posts/' . $post->id . '/vote', [
            'score' => 1
        ])->assertStatus(200);

        $response = $this->get('/api/posts')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'posts',
                            'attributes' => [
                                'votes' => [
                                    'data' => [
                                        [
                                            'data' => [
                                                'type' => 'votes',
                                                'vote_id' => 1,
                                                'attributes' => [
                                                    'score' => 1
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                'user_voted' => 1
                            ]
                        ]
                    ]
                ]
            ]);
    }


}
