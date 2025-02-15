<?php 
$user_type = session()->get('user_type');

if ($user_type == 'user') { 
  echo view('admin/common/sidebar_user');
} else if ($user_type == 'admin') {
  echo view('admin/common/sidebar_admin');
}
?>
