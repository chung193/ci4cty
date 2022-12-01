<?php 
echo view('frontend/components/head', $data);
echo view('frontend/components/header', $data);
echo view('frontend/components/menu', $data);
echo view($data['subview'], $data);
echo view('frontend/components/footer', $data);
?>