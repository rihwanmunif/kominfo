<?php
require 'panggil.php';

// proses tambah
if (!empty($_GET['aksi'] == 'tambah')) {

    $username = strip_tags($_POST['username']);
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    $created_at = strip_tags($_POST['created_at']);
    $update_at = strip_tags($_POST['update_at']);

    $tabel = 'users';
    # proses insert
    $data[] = array(
        'username'        => $username,
        'email'            => $email,
        'password'        => md5($pass),
        'created_at'    => $created_at,
        'update_at'        => $update_at,
    );
    $proses->tambah_data($tabel, $data);
    echo '<script>alert("Tambah Data Berhasil");window.location="../index.php"</script>';
}

// proses edit
if (!empty($_GET['aksi'] == 'edit')) {
    $username = strip_tags($_POST['username']);
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    $created_at = strip_tags($_POST['created_at']);
    $update_at = strip_tags($_POST['update_at']);

    // jika password tidak diisi
    if ($pass == '') {
        $data = array(
            'username'        => $username,
            'email'            => $email,
            'created_at'    => $created_at,
            'update_at'        => $update_at,
        );
    } else {

        $data = array(
            'username'        => $username,
            'email'            => $email,
            'password'        => md5($pass),
            'created_at'    => $created_at,
            'update_at'        => $update_at,
        );
    }
    $tabel = 'users';
    $where = 'id';
    $id = strip_tags($_POST['id']);
    $proses->edit_data($tabel, $data, $where, $id);
    echo '<script>alert("Edit Data Berhasil");window.location="../index.php"</script>';
}

// hapus data
if (!empty($_GET['aksi'] == 'hapus')) {
    $tabel = 'users';
    $where = 'id';
    $id = strip_tags($_GET['hapusid']);
    $proses->hapus_data($tabel, $where, $id);
    echo '<script>alert("Hapus Data Berhasil");window.location="../index.php"</script>';
}

// login
if (!empty($_GET['aksi'] == 'login')) {
    // validasi text untuk filter karakter khusus dengan fungsi strip_tags()
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    // panggil fungsi proses_login() yang ada di class prosesCrud()
    $result = $proses->proses_login($username, $password);
    if ($result == 'gagal') {
        echo "<script>window.location='../login.php?get=gagal';</script>";
    } else {
        // status yang diberikan 
        session_start();
        $_SESSION['ADMIN'] = $result;
        // status yang diberikan 
        echo "<script>window.location='../index.php';</script>";
    }
}
