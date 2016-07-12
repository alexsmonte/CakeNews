<?php
namespace CakeNews\Model\Entity;

use Cake\ORM\Entity;

/**
 * CategoriesPost Entity.
 *
 * @property int $id
 * @property int $category_id
 * @property \CakeNews\Model\Entity\Category $category
 * @property int $post_id
 * @property \CakeNews\Model\Entity\Post $post
 */
class CategoriesPost extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
