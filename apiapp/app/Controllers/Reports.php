<?php namespace App\Controllers;


use CodeIgniter\RESTful\ResourceController;
use FrequencyData;


class Reports extends ResourceController
{
    protected $modelName = 'App\Models\ReportsModel';
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
            'title' => 'required|min_length[3]|max_length[20]',
            'proposeId' => 'required',
            'requestedByUser' => 'required',
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

    public function generate($proposeId){
        helper(['form']);
        $rules = [
            'title' => 'required|min_length[3]|max_length[20]',
            'requestedByUser' => 'required',
        ];
        if (!$this->validate($rules)) {return $this->fail($this->validator->getErrors());}
        else {
            $propose = model('App\Models\ProposesModel', false);
            $proposes = $propose->find($proposeId);
            $data = $this->request->getVar();
            $data->proposeId = $proposeId;
            $data->proposeType = $proposes['type'];
            $data->weight  = $proposes['weight'];
            $data->length  = $proposes['length'];
            $data->age = $proposes['age'];
            $data->salary = $proposes['salary'];
            $data->frequencyType = $proposes['frequencyType'];
            $data->heartRate = $proposes['heartRate'];
            $data->proposeStartDate = $proposes['startDate'];
            $data->proposeEndDate = $proposes['endDate'];
            $data->goal = $proposes['goal'];
            $data->prize = $proposes['prize'];
            $data->proposeStatus = $proposes['isDone'];
            $rId = $this->model->insert($data);
            $data->id = $rId;
            $frequencyDataModel = model('App\Models\FrequencyDataModel', false);
            $frequencyDatas = $frequencyDataModel->where(['proposeId' => $proposeId, 'is_deleted' => 0])->findAll();
            $reportItemModel = model('App\Models\ReportItemModel', false);
            foreach ($frequencyDatas as $frequencyData) {
                $fData = [
                    "title" => $frequencyData['title'],
                    "date" => $frequencyData['date'],
                    "reportId" => $rId,
                    "new_weight" => $frequencyData['new_weight'],
                    "new_money" => $frequencyData['new_money'],
                    "new_heart_rate" => $frequencyData['new_heart_rate'],
                ];
                $iId = $reportItemModel->insert($fData);
                $fData['id']=$iId;
                $data->reportItems[]=$fData;
            }
            $res=[
                "message"=>"Your report has been requested and is awaiting administrator approval"];
            return $res;
        }
    }

    public function show($id = null)
    {
        $reportItemModel = model('App\Models\ReportItemModel', false);
        $reportItems = $reportItemModel->where(['reportId' => $id, 'is_deleted' => 0])->findAll();
        $data = $this->model->where(['is_deleted' => 0])->find($id);
        if ($data) {
            $data['reportItems'] = $reportItems;
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not found');
        }
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not found');
        }
    }
    public function accept_report($id = null)
    {
        helper(['form', 'array']);

        $report = $this->model->find($id);
        if ($report) {
            $data = array(
                'id' => $id,
                'status' => 1
            );
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