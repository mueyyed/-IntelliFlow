<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use FrequencyData;


class Proposes extends ResourceController
{
    protected $modelName = 'App\Models\ProposesModel';
    protected $format = 'json';

    public function index()
    {
        $posts = $this->model->where(['is_deleted' => 0])->findAll();
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
            'title' => 'required|min_length[6]',
            'type' => 'required',
            'age' => 'required',
            'frequencyType' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'goal' => 'required',
            'userId' => 'required',
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
        $frequencyDataModel = model('App\Models\FrequencyDataModel', false);
        $frequencyDatas = $frequencyDataModel->where(['proposeId' => $id, 'is_deleted' => 0])->findAll();
        $data = $this->model->where(['is_deleted' => 0])->find($id);
        if ($data) {
            $data['frequencyDatas'] = $frequencyDatas;
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not found');
        }
    }
    public function givePrize(){
        helper(['form', 'array']);
        $id=$this->request->getVar('id');
        $propose = $this->model->find($id);
        if ($propose) {
                $data['prize'] = $this->request->getVar('prize');
                $data['id'] = $id;
                $this->model->save($data);
                return $this->respond($data);
         } else {
            return $this->failNotFound('Item not found');
        }
    }
    public function endPropose(){
        helper(['form', 'array']);
        $id=$this->request->getVar('id');
        $propose = $this->model->find($id);
        if ($propose) {
            $data['isDone'] = $this->request->getVar('isDone');
            $data['id'] = $id;
            $this->model->save($data);
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
                    'userId' => 'required',
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
    public function showByName()
    {
        helper(['form']);

        $rules = [
            'title' => 'required|min_length[6]',

        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = $this->request->getVar();

            $data = $this->model->where(['is_deleted' => 0, 'title' => $data['title']])->first();

            if ($data) {
                return $this->respond($data);
            } else {
                return $this->failNotFound('Item not founds');
            }
        }
    }
}
