<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CheckinTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CheckinTable Test Case
 */
class CheckinTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CheckinTable
     */
    public $Checkin;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Checkin'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Checkin') ? [] : ['className' => CheckinTable::class];
        $this->Checkin = TableRegistry::getTableLocator()->get('Checkin', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Checkin);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
