<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LocalTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LocalTable Test Case
 */
class LocalTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LocalTable
     */
    public $Local;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Local'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Local') ? [] : ['className' => LocalTable::class];
        $this->Local = TableRegistry::getTableLocator()->get('Local', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Local);

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
