<?php

namespace Tests\Unit\Services;

use App\Exceptions\CollaboratorNotFoundException;
use App\Models\Collaborator;
use App\Services\CollaboratorService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\Paginator;
use Tests\TestCase;
use Tests\Unit\Util\AuthenticatedUser;

class CollaboratorServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $collaboratorService;

    public function setUp(): void
    {
        parent::setUp();
        $this->collaboratorService = new CollaboratorService();
    }

    public function testIndexCollaborator(): void
    {
        $this->be(AuthenticatedUser::getUser());
        $collborators = $this->collaboratorService->index([
            'search' => 'a'
        ]);

        $this->assertInstanceOf(Paginator::class, $collborators);
        $this->assertNotEmpty($collborators);
        $this->assertGreaterThanOrEqual(1, $collborators->count());
    }

    public function testStoreCollaborator()
    {
        $this->be(AuthenticatedUser::getUser());
        $collaborator = $this->storeCollaborator();

        $this->assertInstanceOf(Collaborator::class, $collaborator);
        $this->assertNotEmpty($collaborator);
        $this->assertEquals('Test', $collaborator->name);
    }

    public function testEditCollaborator()
    {
        $this->be(AuthenticatedUser::getUser());
        $collaborator = $this->storeCollaborator();

        $collaborator = $this->collaboratorService->edit($collaborator->id);

        $this->assertInstanceOf(Collaborator::class, $collaborator);
        $this->assertNotEmpty($collaborator);
        $this->assertEquals('Test', $collaborator->name);
    }

    public function testWrongEditCollaborator()
    {
        $this->expectException(CollaboratorNotFoundException::class);
        $this->be(AuthenticatedUser::getUser());
        $collaborator = $this->storeCollaborator();

        $this->collaboratorService->edit($collaborator->id + 1000);
    }

    public function testUpdateCollaborator()
    {
        $this->be(AuthenticatedUser::getUser());
        $collaborator = $this->storeCollaborator();

        $this->collaboratorService->update([
            'name' => 'Test 123'
        ], $collaborator->id);

        $collaborator = $this->collaboratorService->edit($collaborator->id);

        $this->assertInstanceOf(Collaborator::class, $collaborator);
        $this->assertNotEmpty($collaborator);
        $this->assertEquals('Test 123', $collaborator->name);
    }

    public function testInvalidateCollaborator()
    {
        $this->be(AuthenticatedUser::getUser());
        $collaborator = $this->storeCollaborator();

        $this->collaboratorService->status($collaborator->id);
        $collaborator = $this->collaboratorService->edit($collaborator->id);

        $this->assertInstanceOf(Collaborator::class, $collaborator);
        $this->assertNotEmpty($collaborator);
        $this->assertFalse((bool) $collaborator->active);
    }

    private function storeCollaborator()
    {
        return $this->collaboratorService->store([
            'name' => 'Test',
            'email' => 'test@mail.com',
            'position' => 'Dev',
            'admission_date' => '2025-01-01'
        ]);
    }
}
