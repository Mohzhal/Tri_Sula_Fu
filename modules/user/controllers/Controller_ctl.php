<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Controller
{
    var $id_role = '';
    var $id_user = '';
    var $nama = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_user = $this->session->userdata(PREFIX_SESSION.'_id_user');
        $this->nama = $this->session->userdata(PREFIX_SESSION.'_nama');
    }

    public function index()
    {
        $order['order_by'] = 'id_kategori';
        $order['ascdesc'] = 'ASC';
        $result = $this->action_m->get_all('produk',[],$order);
        $kategori = $this->action_m->get_all('kategori');

        $params['arrjoin']['produk']['statement'] = 'produk.id_produk = cart.id_produk';
        $params['arrjoin']['produk']['type'] = 'LEFT';
        $cart = $this->action_m->get_where_params('cart',['id_user' => $this->id_user],'*',$params);

        $arr = [];
        $no = 0;
        if ($kategori) {
            foreach ($kategori as $row) {
                if ($result) {
                    foreach ($result as $key) {
                        if ($row->id_kategori == $key->id_kategori) {
                            $num = $no++;
                            $arr[$row->id_kategori][$num]['id_produk'] = $key->id_produk;
                            $arr[$row->id_kategori][$num]['gambar'] = $key->gambar;
                            $arr[$row->id_kategori][$num]['nama'] = $key->nama;
                            $arr[$row->id_kategori][$num]['harga'] = $key->harga;
                            $arr[$row->id_kategori][$num]['bintang'] = $key->bintang;
                        }else{
                            $no = 0;
                        }
                    }
                }else{
                    $arr[$row->id_kategori] = NULL;
                }
            }
        }


        $mydata['result'] = $arr;
        $mydata['kategori'] = $kategori;
        $mydata['cart'] = $cart;
         // LOAD VIEW
        $this->load->view('index', $mydata);
    }

    public function payment()
    {

         $params['arrjoin']['produk']['statement'] = 'produk.id_produk = cart.id_produk';
        $params['arrjoin']['produk']['type'] = 'LEFT';
        $cart = $this->action_m->get_where_params('cart',['id_user' => $this->id_user],'*',$params);
        if (!$cart) {
            redirect('home');
        }


        $mydata['cart'] = $cart;
         // LOAD VIEW
        $this->load->view('pay', $mydata);
    }
    
}
