<?php

namespace NovaFormEntries\Tests;

use FormEntries\Forms\UniversalForm;
use Illuminate\Http\Request;
use NovaFormEntries\Tests\Fixtures\Models\User;

class FormEntriesTest extends TestCase
{
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create();

        $this->actingAs($this->admin);
    }

    /** @test */
    public function index_list()
    {
        $request = app(Request::class);

        $formEntry = \FormEntries\Forms\UniversalForm::make()
            ->enableStoringData()
            ->enableNotifications()
            ->process($request);

        $this->assertTrue($formEntry->exists);

        $uriKey = \NovaFormEntries\Tests\Fixtures\Nova\Resources\FormEntry::uriKey();

        $response = $this->get("nova-api/{$uriKey}");

        $response->assertJsonPath('label', 'Form Entries');

        $this->assertIsArray($response->json('resources'));
        $this->assertCount(1, $response->json('resources'));
        $this->assertEquals(UniversalForm::class, $response->json('resources.0.fields.2.value'));
    }

    /** @test */
    public function detail()
    {
        /** @var Request $request */
        $request = app(Request::class);

        $request->merge([
            'name' => 'Foo Bar',
        ]);

        $formEntry = \FormEntries\Forms\UniversalForm::make()
            ->enableStoringData()
            ->enableNotifications()
            ->process($request);

        $this->assertTrue($formEntry->exists);

        $uriKey = \NovaFormEntries\Tests\Fixtures\Nova\Resources\FormEntry::uriKey();

        $response = $this->get("nova-api/{$uriKey}/{$formEntry->getKey()}");

        $this->assertStringContainsString('Name:', $response->json('resource.fields.6.value'));
        $this->assertStringContainsString('Foo Bar', $response->json('resource.fields.6.value'));
    }

    /** @test */
    public function cards()
    {
        /** @var Request $request */
        $request = app(Request::class);

        $request->merge([
            'name' => 'Foo Bar',
        ]);

        $formEntry = \FormEntries\Forms\UniversalForm::make()
            ->enableStoringData()
            ->enableNotifications()
            ->process($request);

        $this->assertTrue($formEntry->exists);

        $uriKey = \NovaFormEntries\Tests\Fixtures\Nova\Resources\FormEntry::uriKey();

        $cardsResponse = $this->get("nova-api/{$uriKey}/cards");

        $this->assertIsArray($cardsResponse->json());
        $this->assertCount(2, $cardsResponse->json());

        $response = $this->get("nova-api/{$uriKey}/metrics/{$cardsResponse->json('0.uriKey')}");
        $response->assertJsonPath('value.value', 1);
        $this->assertCount(1, $response->json('value.trend'));


        $response = $this->get("nova-api/{$uriKey}/metrics/{$cardsResponse->json('1.uriKey')}");
        $response->assertJsonPath('value.value.0.label', 'Universal');
        $response->assertJsonPath('value.value.0.value', 1);
        $response->assertJsonPath('value.value.0.percentage', 100);
    }
}
