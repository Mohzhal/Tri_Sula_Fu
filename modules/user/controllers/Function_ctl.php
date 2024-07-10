<?php defined('BASEPATH') or exit('No direct script access allowed');

class Function_ctl extends MY_Controller
{
    var $id_user = '';
    var $nama = '';
    var $foto = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_user = $this->session->userdata(PREFIX_SESSION.'_id_user');
       
        
    }

    // FUNGSI AUTH
    public function login()
    {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        $email = strtolower($email);
        if (!$_POST) {
            redirect('auth');
        }
        if (!$email || !$password) {
            $data['status'] = 700;
            $data['alert']['message'] = 'Tidak ada data terdeteksi! Silahkan cek dan coba lagi.';
            echo json_encode($data);
            exit;
        }
        if (!validasi_email($email)) {
            $data['status'] = 700;
            $data['alert']['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
            echo json_encode($data);
            exit;
        }

        $result = $this->action_m->get_single('user', ['email' => $email]);
        if ($result) {
            if ($result->status == 'N') {
                if ($result->reason) {
                    $reason = ' dengan alasan </br></br><b>' . $result->reason . '!</b></br></br>';
                } else {
                    $reason = '!';
                }
                $data['status'] = 700;
                $data['alert']['message'] = 'Anda telah di blockir' . $reason . ' Anda tidak bisa melakukan akses pada sistem. Hubungi admin jika terjadi kesalahan';
                echo json_encode($data);
                exit;
            }
            if ($result->password == hash_my_password($email . $password)) {

                $arrSession[PREFIX_SESSION.'_id_user'] = $result->id_user;
                $arrSession[PREFIX_SESSION.'_nama'] = $result->nama;

                $this->session->set_userdata($arrSession);

                $data['status'] = 200;
                $data['alert']['message'] = 'Data sesuai! Selamat datang ' . $result->nama;
                $data['reload'] = true;
               
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Kata sandi salah! Silahkan cek dan coba lagi.';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Email tidak terdaftar! Silahkan cek dan coba lagi.';
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function register()
    {
        $nama      = $this->input->post('nama');
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        // PERIKSA URL
        if (!$_POST) {
            redirect('home');
        }
        // PERIKSA INPUT
        if (!$email || !$nama || !$password) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data tidak terdeteksi! Silahkan cek ulang data yang anda masukan';
            echo json_encode($data);
            exit;
        }
        if (!validasi_email($email)) {
            $data['status'] = 700;
            $data['alert']['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
            echo json_encode($data);
            exit;
        }

        // CEK USER
        $result = $this->action_m->get_single('user', ['email' => $email]);
        if ($result) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Email yang anda masukan sudah terdaftar!';
            echo json_encode($data);
            exit;
        }

        $arrInsert['email'] = $email;
        $arrInsert['nama'] = $nama;
        $arrInsert['password'] = hash_my_password($email . $password);
        $insert = $this->action_m->insert('user', $arrInsert);

        if ($insert) {
            $arrSession[PREFIX_SESSION.'_id_user'] = $insert;
            $arrSession[PREFIX_SESSION.'_nama'] = '';


            $this->session->set_userdata($arrSession);

            $data['status'] = 200;
            $data['alert']['message'] = 'Anda berhasil mendaftar! Selamat datang '.$nama;
            $data['reload'] = true;
        } else {
            $data['status'] = 700;
            $data['alert']['message'] = 'Gagal menambah data! silahkan cek data atau coba lagi nanti';
        }
        echo json_encode($data);
        exit;
    }


    public function add_cart()
    {
        $id = $this->input->post('id');
        $post['id_produk'] = $id;
        $post['id_user'] = $this->id_user;

        $insert = $this->action_m->insert('cart',$post);
        if ($insert) {
            $data =  $insert;
        }else{
            $data =  false;
        }
        echo json_encode($data);
        exit;
    }

     public function remove_cart()
    {
        $id = $this->input->post('id');
        $delete = $this->action_m->delete('cart',['id_cart' => $id]);
        if ($delete) {
            $data =  true;
        }else{
            $data =  false;
        }
        echo json_encode($data);
        exit;
    }


    public function checkout()
    {
        $arrVar['nama']       = 'Nama';
        $arrVar['card_number']           = 'Nomor kartu';
        $arrVar['card_expired']           = 'Tenggat kartu';
        $arrVar['cvv']           = 'CVV';
        $arrVar['total']           = 'Total';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                if (!in_array($var,['card_expired'])) {
                    $post[$var] = trim($$var);
                }
                
                $arrAccess[] = true;
            }
        }

        $post['card_expired'] = date('Y-m-d',strtotime($card_expired));

        if (!in_array(false, $arrAccess)) {
            $post['id_user'] = $this->id_user;
            $insert = $this->action_m->insert('checkout', $post);
            if ($insert) {
                $cek = $this->action_m->get_all('cart',['id_user' => $this->id_user]);
                if ($cek) {
                    $no = 0;
                    foreach ($cek as $row) {
                        $num = $no++;
                        $in[$num]['id_checkout'] = $insert;
                        $in[$num]['id_produk'] = $row->id_produk;
                    }

                    $ib = $this->action_m->insert_batch('detail_checkout',$in);
                    if ($ib) {
                        $this->action_m->delete('cart',['id_user' => $this->id_user]);
                    }
                }
                $data['status'] = true;
                $data['alert']['message'] = 'Produk berhasil di checkout!';
                $data['redirect'] = base_url('home');
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Produk gagal di checkout!';
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }

        echo json_encode($data);
        exit;
    }

    public function contact()
    {
        $arrVar['nama']       = 'Nama';
        $arrVar['email']           = 'Email';
        $arrVar['message']           = 'Pesan';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_contact_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                    $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        if (!in_array(false, $arrAccess)) {
            $insert = $this->action_m->insert('contact', $post);
            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Pesan berhasil di kirim!';
                $data['redirect'] = base_url('home');
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Pesan gagal di kirim!';
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }

        echo json_encode($data);
        exit;
    }

    public function logout()
    {
        $this->session->unset_userdata(PREFIX_SESSION.'_id_user');
        $this->session->unset_userdata(PREFIX_SESSION.'_nama');

        redirect('home');
    }

}