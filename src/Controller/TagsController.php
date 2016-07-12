<?php
namespace CakeNews\Controller;

use CakeNews\Controller\AppController;
use Cake\Utility\Hash;

/**
 * Tags Controller
 *
 * @property \CakeNews\Model\Table\TagsTable $Tags
 */
class TagsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $tags = $this->paginate($this->Tags);


        $title  =   'Tags';
        $this->set(compact('tags', 'title'));
        $this->set('_serialize', ['tags', 'title']);
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => ['Posts']
        ]);

        $title  =   'View tag';
        $this->set(compact('tag','title'));
        $this->set('_serialize', ['tag']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function newTag()
    {
        $tag = $this->Tags->newEntity();
        $status =   [];
        if ($this->request->is('post'))
        {
            //$tag->name  =   $this->request->data["name"][0];
            $data   =   ['name' => $this->request->data["name"], 'posts' => ['_ids' => [$this->request->data["posts"]["_ids"]]]];

            if (isset($this->request->data["id"]))
                $tag->id    =   $this->request->data["id"];

            $tag = $this->Tags->patchEntity($tag, $data);
            if ($this->Tags->save($tag))
                $status =   ['id' => $tag->id, 'name' =>$tag->name];
        }

        $this->set(compact('status'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add()
    {

        $tag = $this->Tags->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->data);

            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tag could not be saved. Please, try again.'));
            }
        }

        $title  =   'Add tag';
        $this->set(compact('tag','title'));
        $this->set('_serialize', ['tag']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => ['Posts']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->data);
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tag could not be saved. Please, try again.'));
            }
        }
        $posts = $this->Tags->Posts->find('list');
        $title  =   'Edit tag';
        $this->set(compact('tag', 'posts', 'title'));
        $this->set('_serialize', ['tag']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
        } else {
            $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function showTags()
    {

        $terms  =   $this->Tags->find("all", ['fields' => ['Tags.id', 'Tags.name'], 'conditions' => ["Tags.name LIKE '%".$this->request->query["term"]."%'"]]);
        $tag    =   [];
        foreach ($terms as $term)
            $tag[] = ['id' => $term->id, 'name' => $term->name];

        $this->set(compact('tag'));
    }

    public function remove()
    {
        if ($this->request->is(['patch', 'post', 'put']))
            $this->Tags->remove($this->request->data("post_id"),  $this->request->data("tag_id"));
    }
}
