<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimelogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimelogsTable Test Case
 */
class TimelogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TimelogsTable
     */
    protected $Timelogs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Timelogs',
        'app.Users',
        'app.Projects',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Timelogs') ? [] : ['className' => TimelogsTable::class];
        $this->Timelogs = $this->getTableLocator()->get('Timelogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Timelogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test activeLog method
     *
     * @return void
     */
    public function testActiveLog(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test registro method
     *
     * @return void
     */
    public function testRegistro(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
