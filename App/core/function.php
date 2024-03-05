<?php
class Func
{

    private $url;


    public function __construct()
    {
        if (isset($_REQUEST['url'])) {
            $this->url =  explode('/', filter_var(trim($_REQUEST['url'], '/')));
        }
    }

    public function getUrl()
    {
        return $this->url;
    }



    function handleActive($name)
    {
        $result = [];
        if (empty($this->url)) {
            $display = 'active';
        }

        if ($this->url[0] == $name) {
            $active = 'active';
        }

        $result = [
            'active' => isset($active) ? $active : '',
            'display' => isset($display) ? $display : ''
        ];

        return $result;
    }


    public function handleDisplayPageLink()
    {

        $url = $this->url;
        if (isset($url[1]) && $url[1] !== 'sayHi') {
            return ['display' => 'display:flex', 'url' => $url];
        }
    }

    public function handlePaddingContent()
    {
        $url = $this->url;
        if (isset($url[1]) && $url[1] !== 'sayHi') {
            return 'padding:40px 20px 20px 20px;';
        }
    }

    public function handleNameController()
    {

        switch ($this->url[0]) {
            case 'spending_account':
                return 'Tài khoản';
            case 'category':
                return 'Nhóm chi tiêu';
            case 'transaction':
                return 'Chi tiêu';
            case 'plan':
                return 'Kế hoạch';
            case 'report':
                return 'Báo cáo thống kê';
            case 'overview':
                return 'Tổng quan';
            case 'saving_account':
                return 'Tiền gửi tiết kiệm';
        }
    }

    public function handleNameAction()
    {
        switch ($this->url[1]) {
            case 'add':
                return "Thêm " . strtolower($this->handleNameController());
            case 'edit':
                return "Cập nhật " . strtolower($this->handleNameController());
            case 'detail':
                return "Chi tiết " . strtolower($this->handleNameController());
        }
    }
}
