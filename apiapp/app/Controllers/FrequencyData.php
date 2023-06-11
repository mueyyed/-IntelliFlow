<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class FrequencyData extends ResourceController
{
    protected $modelName = 'App\Models\FrequencyDataModel';
    protected $format = 'json';

    public function index()
    {
        $posts = $this->model->where(['is_deleted' => 0])->findAll();
        return $this->respond($posts);
    }

    public function create()
    {
        helper(['form']);

        $rules = [
            'title' => 'required|min_length[6]',
            'proposeId' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = $this->request->getVar();
            $id = $this->model->insert($data);
            $data->id = $id;
            return $this->respondCreated($data);
        }
    }

    public function show($id = null)
    {
        $data = $this->model->where(['is_deleted' => 0])->find($id);
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
                'title' => 'required|min_length[6]',
                'proposeId' => 'required'
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

    //--------------------------------------------------------------------

    public function showByPropose($id = null)
    {
        $posts = $this->model->where(['is_deleted' => 0,'proposeId'=>$id])->findAll();
        return $this->respond($posts);
    }
}
