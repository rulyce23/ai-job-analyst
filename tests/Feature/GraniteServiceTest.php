<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\GraniteService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GraniteServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $graniteService;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Mock the GraniteService for testing
        $this->graniteService = $this->createMock(GraniteService::class);
        $this->app->instance(GraniteService::class, $this->graniteService);
    }

    /** @test */
    public function it_can_analyze_job_description()
    {
        $mockResponse = [
            'skills_required' => ['PHP', 'Laravel', 'MySQL'],
            'experience_level' => 'senior',
            'salary_range' => '$80,000 - $120,000',
            'key_responsibilities' => [
                'Develop and maintain web applications',
                'Lead technical projects'
            ],
            'growth_opportunities' => [
                'Technical leadership',
                'Architecture design'
            ],
            'market_demand' => 'high',
            'recommended_certifications' => [
                'AWS Certified Developer',
                'Laravel Certification'
            ]
        ];

        $this->graniteService
            ->expects($this->once())
            ->method('analyzeJobDescription')
            ->with(
                'We are looking for a Senior Software Engineer...',
                ['PHP', 'Laravel', 'MySQL']
            )
            ->willReturn($mockResponse);

        $response = $this->postJson('/api/ai/analyze-job', [
            'job_description' => 'We are looking for a Senior Software Engineer...',
            'requirements' => ['PHP', 'Laravel', 'MySQL']
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'data' => $mockResponse
                ]);
    }

    /** @test */
    public function it_can_generate_job_recommendations()
    {
        $mockResponse = [
            'recommended_positions' => [
                [
                    'title' => 'Senior Full Stack Developer',
                    'match_percentage' => 85,
                    'reason' => 'Strong PHP background matches requirements',
                    'required_skills' => ['PHP', 'JavaScript', 'React'],
                    'salary_range' => '$90,000 - $130,000',
                    'companies' => ['TechCorp', 'StartupXYZ']
                ]
            ],
            'skill_gaps' => ['React', 'AWS'],
            'learning_path' => [
                'Learn React fundamentals',
                'Complete AWS certification'
            ],
            'market_insights' => 'High demand for full-stack developers'
        ];

        $this->graniteService
            ->expects($this->once())
            ->method('generateJobRecommendations')
            ->with(
                'Experienced PHP developer with 5 years...',
                ['trends' => ['Remote work'], 'hot_skills' => ['Python']]
            )
            ->willReturn($mockResponse);

        $response = $this->postJson('/api/ai/generate-recommendations', [
            'candidate_profile' => 'Experienced PHP developer with 5 years...',
            'job_market' => [
                'trends' => ['Remote work'],
                'hot_skills' => ['Python']
            ]
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'data' => $mockResponse
                ]);
    }

    /** @test */
    public function it_can_analyze_resume()
    {
        $mockResponse = [
            'contact_info' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '+1-555-0123',
                'location' => 'San Francisco, CA'
            ],
            'skills' => ['PHP', 'Laravel', 'MySQL', 'JavaScript'],
            'experience' => [
                [
                    'title' => 'Senior Software Engineer',
                    'company' => 'TechCorp',
                    'duration' => '3 years',
                    'achievements' => [
                        'Led development of 5 major features',
                        'Mentored 3 junior developers'
                    ]
                ]
            ],
            'education' => [
                [
                    'degree' => 'Bachelor of Computer Science',
                    'institution' => 'University of Technology',
                    'year' => '2018'
                ]
            ],
            'certifications' => ['AWS Certified Developer'],
            'languages' => ['English', 'Spanish'],
            'strengths' => ['Problem solving', 'Team leadership'],
            'areas_for_improvement' => ['Machine Learning', 'DevOps']
        ];

        $this->graniteService
            ->expects($this->once())
            ->method('analyzeResume')
            ->with('John Doe\nSoftware Engineer\n5 years experience...')
            ->willReturn($mockResponse);

        $response = $this->postJson('/api/ai/analyze-resume', [
            'resume_text' => 'John Doe\nSoftware Engineer\n5 years experience...'
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'data' => $mockResponse
                ]);
    }

    /** @test */
    public function it_returns_model_status()
    {
        $response = $this->getJson('/api/ai/model-status');

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'data' => [
                        'model' => 'IBM Granite 13B Chat v2',
                        'provider' => 'IBM watsonx.ai',
                        'status' => 'available'
                    ]
                ])
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'model',
                        'capabilities',
                        'provider',
                        'status'
                    ]
                ]);
    }

    /** @test */
    public function it_validates_required_fields_for_job_analysis()
    {
        $response = $this->postJson('/api/ai/analyze-job', []);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['job_description']);
    }

    /** @test */
    public function it_validates_required_fields_for_recommendations()
    {
        $response = $this->postJson('/api/ai/generate-recommendations', []);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['candidate_profile']);
    }

    /** @test */
    public function it_validates_required_fields_for_resume_analysis()
    {
        $response = $this->postJson('/api/ai/analyze-resume', []);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['resume_text']);
    }

    /** @test */
    public function it_handles_service_errors_gracefully()
    {
        $this->graniteService
            ->expects($this->once())
            ->method('analyzeJobDescription')
            ->willReturn(null);

        $response = $this->postJson('/api/ai/analyze-job', [
            'job_description' => 'Test job description',
            'requirements' => ['PHP']
        ]);

        $response->assertStatus(500)
                ->assertJson([
                    'success' => false,
                    'message' => 'Failed to analyze job description'
                ]);
    }
} 