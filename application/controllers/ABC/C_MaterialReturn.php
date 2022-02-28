<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_MaterialReturn extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $title = 'Material Return';
    $script = '<script src="' . base_url('js/iph/inventory/material_receive.js') . '" type="module"></script>';

    $data_view = [
      'title' => $title
    ];
    $content = $this->load->view('iph/content/material_receive', $data_view, true);

    $data = [
      'title' => $title,
      'content' => $content,
      'script' => $script
    ];
    $this->load->view('iph/layout/main', $data);
  }
}
