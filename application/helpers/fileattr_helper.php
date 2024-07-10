<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


    function create_txt($nama = '',$txt = '',$path = './data/dokumen/')
    {
        if ($nama == '') {
            $nama = date('YmdHis');
        }
        $myfile = fopen($path.$nama.'.txt', "w") or die("Unable to open file!");
        fwrite($myfile, $txt);
        fclose($myfile);
        
        if (file_exists($path . $nama.'.txt')) {
           return 200;
        }else{
            return 500;
        }
    }

    function read_txt($nama = '',$path = './data/dokumen/')
    {
        if ($nama == '') {
            $data['kode'] = 500;
            $data['msg'] = 'Nama file tidak ditemukan';
        }else{
            if (!file_exists($path . $nama)) {
                $data['kode'] = 700;
                $data['msg'] = 'Lokasi file tidak ditemukan';
            }else{
                if (filesize($path.$nama) > 0) {
                    $myfile = fopen($path.$nama, "r") or die("Unable to open file!");
                    $value = fread($myfile,filesize($path.$nama));
                    fclose($myfile);
                    $data['kode'] = 200;
                    $data['value'] = $value;
                }else{
                    $data['kode'] = 500;
                    $data['msg'] = 'File kosong!';
                }
                
            }
        }
        

        return $data;
    }
?>