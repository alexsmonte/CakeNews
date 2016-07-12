<?php
namespace CakeNews\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $resume
 * @property string $content
 * @property string $slug
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \CakeNews\Model\Entity\Attachment[] $attachments
 * @property \CakeNews\Model\Entity\Comment[] $comments
 * @property \CakeNews\Model\Entity\Category[] $categories
 * @property \CakeNews\Model\Entity\Tag[] $tags
 */
class Post extends Entity
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
