<?php namespace App\Controllers;


use CodeIgniter\RESTful\ResourceController;
use FrequencyData;


class Users extends ResourceController
{
    protected $modelName = 'App\Models\UsersModel';
    protected $format = 'json';

    public function index()
    {
        $posts = $this->model->findAll();
        return $this->respond($posts);
    }

    public function showByUser($id = null)
    {
        $posts = $this->model->where(['is_deleted' => 0, 'userId' => $id])->findAll();
        return $this->respond($posts);
    }

    public function create()
    {
        helper(['form']);

        $rules = [
            'fullname' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]', // Random 15 Key
            'password_confirm' => 'required|matches[password]',
            'role' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = $this->request->getVar();
            $id = $this->model->insert($data);
            $data['id'] = $id;
            return $this->respondCreated($data);
        }
    }

    public function show($id = null)
    {
         $data = $this->model->find($id);
        if ($data) {
             return $this->respond($data);
        } else {
            return $this->failNotFound('Item not found');
        }
    }

    public function update($id = null)
    {
        helper(['form', 'array']);

        $branch = $this->model->find($id);
        if ($branch) {
            $rules = [
                'fullname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]', // Random 15 Key
                'password_confirm' => 'required|matches[password]',
                'role' => 'required',
            ];


            if (!$this->validate($rules)) {
                return $this->fail($this->validator->getErrors());
            } else {

                $data = $this->request->getVar();
                $date['id'] = $id;

                $this->model->save($data);
                return $this->respond($data);
            }
        } else {
            return $this->failNotFound('Item not found');
        }

    }

    public function trash($id = null)
    {
        helper(['form', 'array']);

        $branch = $this->model->find($id);
        if ($branch) {


            $data = array(
                'id' => $id,
                'is_deleted' => 1
            );
            $this->model->save($data);
            return $this->respond($data);

        } else {
            return $this->failNotFound('Item not found');
        }
    }

    public function delete($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            $this->model->delete($id);
            return $this->respondDeleted($data);
        } else {
            return $this->failNotFound('Item not found');
        }
    }

}