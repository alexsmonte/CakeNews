<?php
namespace CakeNews\Model\Table;

use CakeNews\Model\Entity\Tag;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Tags Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Posts
 */
class TagsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('ckn_tags');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Posts', [
            'foreignKey' => 'tag_id',
            'targetForeignKey' => 'post_id',
            'joinTable' => 'ckn_posts_tags',
            'className' => 'CakeNews.Posts'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    public function remove($post_id, $tag_id)
    {
        $SQL_tag_remove = TableRegistry::get('CakeNews.cknPostsTags');

        if (!is_numeric($tag_id))
        {
            $tagNameId  =   $this->find("all", ["fields" => ["Tags.id", "Tags.name"],"conditions" => ["Tags.name" => $tag_id]])->toArray();
            $tag_id     =   $tagNameId[0]["id"];
        }

        $query = $SQL_tag_remove->query();
        $query->delete()
            ->where(['post_id'=> $post_id,'tag_id'=> $tag_id])
            ->execute();
    }
}
