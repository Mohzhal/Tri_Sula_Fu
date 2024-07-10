<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function load_pagination($url, $limit, $total)
{
    $CI = &get_instance();
    $CI->load->library('pagination');

    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['base_url'] = base_url() . $url;
    $config['total_rows'] = $total;
    $config['per_page'] = $limit;

    // TAG PRENT
    $config['full_tag_open'] = ' <ul class="pagination pagination-circle pagination-outline mt-5">';
    $config['full_tag_close'] = '</ul>';

    // FIRST TAG OPEN
    $config['first_tag_open'] = ' <li onclick="pagination(this,event)" class="page-item first m-1">';
    $config['first_tag_close'] = '</li>';

    // PREV TAG
    $config['prev_link'] = '<i class="ki-duotone ki-double-left fs-2"><span class="path1"></span><span class="path2"></span></i>';
    $config['prev_tag_open'] = '<li onclick="pagination(this,event)" class="page-item first m-1">';
    $config['prev_tag_close'] = '</li>';
    // NEXT TAG
    $config['next_link'] = '<i class="ki-duotone ki-double-right fs-2"><span class="path1"></span><span class="path2"></span></i>';
    $config['next_tag_open'] = ' <li onclick="pagination(this,event)" class="page-item last m-1">';
    $config['next_tag_close'] = '</li>';



    $config['last_tag_open'] = '<li onclick="pagination(this,event)" class="page-item m-1">';
    $config['last_tag_close'] = '</li>';
    // ACTIVE TAG
    $config['cur_tag_open'] = ' <li class="page-item active m-1"><a class="page-link">';
    $config['cur_tag_close'] = '</a></li>';

    $config['attributes'] = array('class' => 'page-link px-0 cursor-pointer');

    // NUMTAG
    $config['num_tag_open'] = '<li onclick="pagination(this,event)" class="page-item m-1">';
    $config['num_tag_close'] = '</li>';
    $CI->pagination->initialize($config);
}
