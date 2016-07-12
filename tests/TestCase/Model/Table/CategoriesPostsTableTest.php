<?php
namespace CakeNews\Test\TestCase\Model\Table;

use CakeNews\Model\Table\CategoriesPostsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * CakeNews\Model\Table\CategoriesPostsTable Test Case
 */
class CategoriesPostsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CakeNews\Model\Table\CategoriesPostsTable
     */
    public $CategoriesPosts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.cake_news.categories_posts',
        'plugin.cake_news.categories',
        'plugin.cake_news.posts',
        'plugin.cake_news.attachments',
        'plugin.cake_news.users',
        'plugin.cake_news.comments',
        'plugin.cake_news.ckn_categories_posts',
        'plugin.cake_news.tags',
        'plugin.cake_news.ckn_posts_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CategoriesPosts') ? [] : ['className' => 'CakeNews\Model\Table\CategoriesPostsTable'];
        $this->CategoriesPosts = TableRegistry::get('CategoriesPosts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CategoriesPosts);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
