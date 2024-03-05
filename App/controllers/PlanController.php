<?php
class PlanController extends BaseController
{
    private $planModel;
    private $categoryModel;


    public function __construct()
    {
        $this->planModel = $this->model('PlanModel');
        $this->categoryModel = $this->model('CategoryModel');
    }

    public function sayHi()
    {
        $categories = $this->categoryModel->getAll();
        $plans = $this->planModel->getAll();
        $this->view('main-layout', [
            'page' => 'plans/index',
            'pageName' => 'Danh sách kế hoạch chi tiêu',
            'plans' => $plans,
            'categories' => $categories
        ]);
    }



    public function add()
    {
        $categories = $this->categoryModel->getCategoryOrderBy();
        $this->view('main-layout', [
            'page' => 'plans/add',
            'pageName' => 'Thêm kế hoạch chi tiêu',
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $name = $_POST['name'];
        $money_number = $_POST['money_number'];
        $description = $_POST['description'];
        $time = $_POST['time'];
        $group_transaction_id = $_POST['group_transaction_id'];

        if ($name && $money_number && $description && $group_transaction_id && $time) {
            $data = [
                'name' => $name,
                'money_number' => $money_number,
                'description' => $description,
                'time' => $time,
                'group_transaction_id' => $group_transaction_id
            ];
            $this->planModel->create($data);
            header("location: sayHi");
        } else {
            header("location:add");
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $categories = $this->categoryModel->getCategoryOrderBy();
        $plan = $this->planModel->find($id);
        $this->view('main-layout', [
            'page' => 'plans/edit',
            'pageName' => 'cập nhật tài khoản',
            'plan' => $plan,
            'categories' => $categories
        ]);
    }

    public function update()
    {
        $id = $_GET['id'];
        $data = [];
        $name = $_POST['name'];
        $money_number = $_POST['money_number'];
        $description = $_POST['description'];
        $time = $_POST['time'];
        $group_transaction_id = $_POST['group_transaction_id'];

        $plan = $this->planModel->find($id);


        if ($name && $name != $plan['name']) {
            $data['name'] = $name;
        }

        if ($money_number && $money_number != $plan['money_number']) {
            $data['money_number'] = $money_number;
        }

        if ($description && $description != $plan['description']) {
            $data['description'] = $description;
        }

        if ($time && $time != $plan['time']) {
            $data['time'] = $time;
        }

        if ($group_transaction_id && $group_transaction_id != $plan['group_transaction_id']) {
            $data['group_transaction_id'] = $group_transaction_id;
        }

        if (count($data) > 0) {
            $this->planModel->update($id, $data);
            header("location:sayHi");
        } else {
            header("location:edit&id=${id}");
        }
    }

    public function delete()
    {
        $id = $_POST['id'];
        if ($id) {
            $this->planModel->destroy($id);
            header("location:sayHi");
        } else {
            header("location:sayHi");
        }
    }
}
