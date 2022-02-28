<?php
function convertRupiah($angka)
{
  // $hasil_rupiah = "IDR" . number_format($angka, 0, ',', '.');
  $hasil_rupiah = number_format($angka, 2, ',', '.');
  return $hasil_rupiah;
}

function convertAngka($angka)
{
  if (is_double($angka)) {
    $result = number_format($angka, 2, ',', '.');
  } else {
    $result = number_format($angka, 0, ',', '.');
  }
  return $result;
}

function convertDouble($angka)
{
  $result =  number_format($angka, 2, ',', '.');
  return $result;
}

function countSalesOrder()
{
  $ci = get_instance();
  $ci->load->model('AssemblyOrder_model', 'order');

  return $ci->order->M_get_sales_order()->num_rows();
}

function random_word($id)
{
  $pool = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';

  $word = '';
  for ($i = 0; $i < $id; $i++) {
    $word .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
  }
  return $word;
}

function calculate_stock($stock, $qty, $type, $remarks = null)
{
  switch ($remarks) {
    case 'Receipt':
      $type = 'add';
      break;

    case 'Issue':
      $type = 'sub';
      break;

    default:

      break;
  }

  switch ($type) {
    case 'add':
      return $stock + $qty;
      break;

    case 'sub':
      return $stock - $qty;
      break;
  }
}

function group_array($key, $data)
{
  $result = [];

  foreach ($data as $val) {
    if (array_key_exists($key, $val)) {
      $result[$val[$key]][] = $val;
    } else {
      $result[""][] = $val;
    }
  }

  return $result;
}

function check_login_session()
{
  $ci = get_instance();
  if ($ci->session->userdata('log_ses') != 'login') {
    $ci->session->set_flashdata('notif', '<div class="alert alert-danger"><center><font color="red"><b>Login First</b></font></center></div>');
    return redirect('Login');
  }
}

function auth_admin()
{
  // $ci = get_instance();
  // if ($ci->session->userdata('uid') !== '0002') {
  //   redirect('APOS');
  // }
  $ci = get_instance();
  if ($ci->session->userdata('log_ses') != 'login') {
    $ci->session->set_flashdata('notif', '<div class="alert alert-danger"><center><font color="red"><b>Login First</b></font></center></div>');
    return redirect('Login');
  }
}


function kata($x)
{
  $x = abs($x);
  $angka = array(
    "", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
  );
  $temp = "";
  if ($x < 12) {
    $temp = " " . $angka[$x];
  } else if ($x < 20) {
    $temp = kata($x - 10) . " belas";
  } else if ($x < 100) {
    $temp = kata($x / 10) . " puluh" . kata($x % 10);
  } else if ($x < 200) {
    $temp = " seratus" . kata($x - 100);
  } else if ($x < 1000) {
    $temp = kata($x / 100) . " ratus" . kata($x % 100);
  } else if ($x < 2000) {
    $temp = " seribu" . kata($x - 1000);
  } else if ($x < 1000000) {
    $temp = kata($x / 1000) . " ribu" . kata($x % 1000);
  } else if ($x < 1000000000) {
    $temp = kata($x / 1000000) . " juta" . kata($x % 1000000);
  } else if ($x < 1000000000000) {
    $temp = kata($x / 1000000000) . " milyar" . kata(fmod($x, 1000000000));
  } else if ($x < 1000000000000000) {
    $temp = kata($x / 1000000000000) . " trilyun" . kata(fmod($x, 1000000000000));
  }
  return $temp;
}

function terbilang($x, $style = 3)
{
  if ($x < 0) {
    $hasil = "minus " . trim(kata($x));
  } else {
    $hasil = trim(kata($x));
  }
  switch ($style) {
    case 1:
      // mengubah semua karakter menjadi huruf besar
      $hasil = strtoupper($hasil);
      break;
    case 2:
      // mengubah karakter pertama dari setiap kata menjadi huruf besar
      $hasil = ucwords($hasil);
      break;
    case 3:
      // mengubah karakter pertama menjadi huruf besar
      $hasil = ucfirst($hasil);
      break;
  }
  return $hasil;
}
