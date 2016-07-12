<?php
namespace CakeNews\Controller;

use CakeNews\Controller\AppController;

/**
 * Posts Controller
 *
 * @property \CakeNews\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $this->paginate = ['order' => ['Posts.created DESC'],
            'contain' => ['Categories', 'Tags']
        ];
        $posts = $this->paginate($this->Posts);

        $title  =   'Posts';

        $this->set(compact('posts','title'));
        $this->set('_serialize', ['posts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Categories', 'Tags']
        ]);

        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }
    /**
     * View method
     *
     * @param string $slug Post slug.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function postView($slug)
    {

        $query   =   $this->Posts->find("all", ['conditions' => ['Posts.slug' => $slug], 'contain' => ['Categories', 'Tags', 'Attachments', 'Comments']]);

        $post   =   $query->first();

        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {

            if (!empty($this->request->data["tags"]))
            $this->request->data["tags"]  =   json_decode($this->request->data["tags"], true);

            $post = $this->Posts->patchEntity($post, $this->request->data);

            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));
                return $this->redirect(['action' => 'edit', $post->id]);
            } else {
                $this->Flash->error(__('The post could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Posts->Categories->find('list');
        $tags = $this->Posts->Tags->find('all', ['fields' => ['Tags.id', 'Tags.name']])->toArray();

        $title  =   'Add new post';
        $this->set(compact('post', 'categories', 'tags','title'));
        $this->set('_serialize', ['post','tags']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Tags', 'Categories']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            if (!empty($this->request->data["tags"]))
                $this->request->data["tags"]  =   json_decode($this->request->data["tags"], true);

            $post = $this->Posts->patchEntity($post, $this->request->data, ['associated' => ['tags' => ['accessibleFields' => ['id' => true]], 'categories' => ['accessibleFields' => ['id' => true]]]]);

            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));
                return $this->redirect(['action' => 'edit',$id]);
            } else {
                $this->Flash->error(__('The post could not be saved. Please, try again.'));
            }
        }

        $title  =   'Edit post';

        $categories = $this->Posts->Categories->find('list');
        $tags = $this->Posts->Tags->find('all', ['fields' => ['Tags.id', 'Tags.name']])->toArray();
        $this->set(compact('post', 'categories', 'tags', 'title'));
        $this->set('_serialize', ['post', 'tags']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
