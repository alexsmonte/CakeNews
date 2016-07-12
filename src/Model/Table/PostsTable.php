<?php
namespace CakeNews\Model\Table;

use CakeNews\Model\Entity\Post;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Model
 *
 * @property \Cake\ORM\Association\HasMany $Attachments
 * @property \Cake\ORM\Association\HasMany $Comments
 * @property \Cake\ORM\Association\BelongsToMany $Categories
 * @property \Cake\ORM\Association\BelongsToMany $Tags
 */
class PostsTable extends Table
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


        $this->table('ckn_posts');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Categories', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'ckn_categories_posts',
            'className' => 'CakeNews.Categories'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'ckn_posts_tags',
            'className' => 'CakeNews.Tags'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->allowEmpty('resume');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        return $validator;
    }


    public function latestNews($option = [])
    {
        $options  =   [
            'post_not_in' => null,
            'category_name' => null,
            'category_id'   => null,
            'limit' => 20
        ];

        $options    =   array_merge($options, $option);

        $query   =  $this->find("all", ['contain' =>['Categories','Tags']]);

            if(!is_null($options["category_name"])){
                $query->matching('Categories');
                $query->where(['Categories.slug' => $options["category_name"]]);
            }

            if(!is_null($options["post_not_in"])){
                $query->where(function ($exp, $q) {
                    return $exp->notIn('Posts.id', [10,4]);
                });
            }

        $query->order(['Posts.created' => 'DESC']);
        $query->limit($options["limit"]);

        return $query;
    }



    protected function validOptions()
    {
        ksort($options);
        foreach ($options as $option => $values) {
            if (isset($valid[$option], $values)) {
                $this->{$valid[$option]}($values);
            } else {
                $this->_options[$option] = $values;
            }
        }
    }
}
