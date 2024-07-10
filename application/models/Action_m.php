<?php if (!defined('BASEPATH')) exit('No direct script allowed');

class Action_m extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_single($tabel, $array = [],$order = NULL)
    {

        if (count($array) > 0) {

            $this->db->select()->from($tabel)->where($array);
            if ($order != NULL) {
                $this->db->order_by($order['order_by'], $order['ascdesc']);
            }

            $query = $this->db->get();

            return $query->row();
        } else {

            $this->db->select()->from($tabel)->order_by($this->_order_by);

            $query = $this->db->get();

            return $query->result();
        }
    }

    public function sum($tabel, $sum = NULL, $array = [])
    {

        $select = '';
        if ($sum == NULL) {
            return FALSE;
        }
        if (isset($sum['kolom'])) {
            $select .= 'SUM(' . $sum['kolom'] . ')';
            if (!isset($sum['as'])) {
                $select .= ' AS ' . $sum['as'];
            }
        } else {
            return FALSE;
        }

        $this->db->select($select);
        $this->db->from($tabel);
        if (count($array) > 0) {
            foreach ($array as $field => $value) {
                if (is_array($value)) {
                    $this->db->where_in($field, $value);
                } else {
                    $this->db->where($field, $value);
                }
            }
        }
        $result = $this->db->get();
        if ($result == false) {
            return 0;
        } else {
            return $result;
        }
    }

    public function cnt_where_params($tabel, $where = null, $select = "*", $params = array(), $or_where = null)
    {


        if ($where != NULL) {
            foreach ($where as $field => $value) {
                if (is_array($value)) {
                    $this->db->where_in($field, $value);
                } else {
                    $this->db->where($field, $value);
                }
            }
        }



        if (isset($params['between'])) {

            if ($params['between']['start'] != $params['between']['end']) {

                $awal = $params['between']['start'];

                $akhir = $params['between']['end'];

                if ($awal < $akhir) {

                    $this->db->where($params['between']['columnname'] . " BETWEEN '" . $awal . "' AND '" . $akhir . "'");
                } else if ($awal > $akhir) {

                    $a = $akhir;

                    $akhir = $awal;

                    $awal = $a;

                    $this->db->where($params['between']['columnname'] . " BETWEEN '" . $awal . "' AND '" . $akhir . "'");
                }
            } else if ($params['between']['start'] == $params['between']['end']) {

                $this->db->where($params['between']['columnname'], $params['between']['start']);
            }
        }



        if (isset($params['search']) && !empty($params['search'])) {

            if (count($params['columnsearch']) > 0) {

                $this->db->group_start();

                $i = 1;

                foreach ($params['columnsearch'] as $columnname) {

                    if ($i == 1) {

                        $this->db->like($columnname, $params['search']);
                    } else {

                        $this->db->or_like($columnname, $params['search']);
                    }

                    $i++;
                }

                $this->db->group_end();
            }
        }

        if (isset($params['where_in'])) {
            $this->db->where_in($params['where_in']['kolom'], $params['where_in']['value']);
        }
        if (isset($params['not_where_in'])) {
            $this->db->where_not_in($params['not_where_in']['kolom'], $params['not_where_in']['value']);
        }

        if (isset($params['arrjoin'])) {



            foreach ($params['arrjoin'] as $table => $statement) {

                $type = (isset($statement['type']) && $statement['type'] != '') ? $statement['type'] : 'INNER';



                $this->db->join($table, $statement['statement'], $type);
            }
        }





        if (isset($params['groupby'])) {

            $this->db->group_by($params['groupby']);
        }



        if (isset($params['arrorderby'])) {

            $this->db->order_by($params['arrorderby']['kolom'], $params['arrorderby']['order']);
        }

        if (isset($params['sort']) && isset($params['order'])) {

            if ($params['sort'] != '') {

                if ($params['order'] == '') {

                    $order = 'asc';
                } else {

                    $order = $params['order'];
                }

                $this->db->order_by($params['sort'], $order);
            }
        }
        if ($or_where != NULL) {
            foreach ($or_where as $field => $value) {
                $this->db->or_where($field, $value);
            }
        }



        if (isset($params['limit'])) {

            if (isset($params['offset'])) {

                $this->db->limit($params['limit'], $params['offset']);
            } else {

                $this->db->limit($params['limit']);
            }
        }




        // $this->db->order_by($this->_primary_key,$this->_ascdesc);

        $this->db->select($select);



        $this->db->from($tabel);

        $q = $this->db->get();

        if ($q->num_rows() > 0) {

            return $q->num_rows();
        } else {

            return false;
        }
    }
    public function get($tabel, $array = [], $order, $limit = 0, $start = 0)
    {

        if (count($array) > 0) {

            if ($limit > 0) {

                if ($start > 0) {

                    $this->db->limit($limit, $start);
                } else {

                    $this->db->limit($limit);
                }
            }

            $this->db->from($tabel);
            foreach ($array as $field => $value) {
                if (is_array($value)) {
                    $this->db->where_in($field, $value);
                } else {
                    $this->db->where($field, $value);
                }
            }
            $this->db->order_by($order['order_by'], $order['ascdesc']);

            $query = $this->db->get();

            return $query->result();
        } else {

            if ($limit > 0) {

                if ($start > 0) {

                    $this->db->limit($limit, $start);
                } else {

                    $this->db->limit($limit);
                }
            }

            $this->db->from($tabel)->order_by($order['order_by'], $order['ascdesc']);

            $query = $this->db->get();

            return $query->result();
        }
    }

    public function get_all($tabel, $array = [], $order = NULL)
    {
        $this->db->from($tabel);
        if (count($array) > 0) {
            foreach ($array as $field => $value) {
                if (is_array($value)) {
                    $this->db->where_in($field, $value);
                } else {
                    $this->db->where($field, $value);
                }
            }
        }
        if ($order != null) {
            $this->db->order_by($order['order_by'], $order['ascdesc']);
        }
        $query = $this->db->get();

        return $query->result();
    }
    public function cnt_get_all($tabel, $array = [], $order = NULL)
    {
        $this->db->from($tabel);
        if (count($array) > 0) {
            foreach ($array as $field => $value) {
                if (is_array($value)) {
                    $this->db->where_in($field, $value);
                } else {
                    $this->db->where($field, $value);
                }
            }
        }
        if ($order != null) {
            $this->db->order_by($order['order_by'], $order['ascdesc']);
        }
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function insert($tabel, $array)
    {


        $this->db->insert($tabel, $array);

        $id = $this->db->insert_id();

        return $id;
    }

    public function insert_batch($tabel, $array)
    {


        $res = $this->db->insert_batch($tabel, $array);
        return $res;
    }
    public function update($tabel, $data, $where = array())
    {


        $this->db->set($data);

        $this->db->where($where);

        return $this->db->update($tabel);
    }

    public function update_batch($tabel, $data, $primary)
    {

        return $this->db->update_batch($tabel, $data, $primary);
    }

    public function delete($tabel, $where)
    {



        $this->db->where($where);

        return $this->db->delete($tabel);
    }
    public function delete_batch($tabel, $where = null)
    {


        if ($where != null) {
            foreach ($where as $field => $value) {
                if (is_array($value)) {
                    $this->db->where_in($field, $value);
                } else {
                    $this->db->where($field, $value);
                }
            }
            return $this->db->delete($tabel);
        } else {
            return NULL;
        }
    }

    public function get_where_params($tabel, $where = null, $select = "*", $params = array(), $or_where = null)
    {


        if ($where != NULL) {
            foreach ($where as $field => $value) {
                if (is_array($value)) {
                    $this->db->where_in($field, $value);
                } else {
                    $this->db->where($field, $value);
                }
            }
        }



        if (isset($params['between'])) {

            if ($params['between']['start'] != $params['between']['end']) {

                $awal = $params['between']['start'];

                $akhir = $params['between']['end'];

                if ($awal < $akhir) {

                    $this->db->where($params['between']['columnname'] . " BETWEEN '" . $awal . "' AND '" . $akhir . "'");
                } else if ($awal > $akhir) {

                    $a = $akhir;

                    $akhir = $awal;

                    $awal = $a;

                    $this->db->where($params['between']['columnname'] . " BETWEEN '" . $awal . "' AND '" . $akhir . "'");
                }
            } else if ($params['between']['start'] == $params['between']['end']) {

                $this->db->where($params['between']['columnname'], $params['between']['start']);
            }
        }



        if (isset($params['search']) && !empty($params['search'])) {

            if (count($params['columnsearch']) > 0) {

                $this->db->group_start();

                $i = 1;

                foreach ($params['columnsearch'] as $columnname) {

                    if ($i == 1) {

                        $this->db->like($columnname, $params['search']);
                    } else {

                        $this->db->or_like($columnname, $params['search']);
                    }

                    $i++;
                }

                $this->db->group_end();
            }
        }

        if (isset($params['where_in'])) {
            $this->db->where_in($params['where_in']['kolom'], $params['where_in']['value']);
        }
        if (isset($params['not_where_in'])) {
            $this->db->where_not_in($params['not_where_in']['kolom'], $params['not_where_in']['value']);
        }

        if (isset($params['arrjoin'])) {



            foreach ($params['arrjoin'] as $table => $statement) {

                $type = (isset($statement['type']) && $statement['type'] != '') ? $statement['type'] : 'INNER';



                $this->db->join($table, $statement['statement'], $type);
            }
        }





        if (isset($params['groupby'])) {

            $this->db->group_by($params['groupby']);
        }



        if (isset($params['arrorderby'])) {

            $this->db->order_by($params['arrorderby']['kolom'], $params['arrorderby']['order']);
        }

        if (isset($params['sort']) && isset($params['order'])) {

            if ($params['sort'] != '') {

                if ($params['order'] == '') {

                    $order = 'asc';
                } else {

                    $order = $params['order'];
                }

                $this->db->order_by($params['sort'], $order);
            }
        }
        if ($or_where != NULL) {
            foreach ($or_where as $field => $value) {
                $this->db->or_where($field, $value);
            }
        }



        if (isset($params['limit'])) {

            if (isset($params['offset'])) {

                $this->db->limit($params['limit'], $params['offset']);
            } else {

                $this->db->limit($params['limit']);
            }
        }




        // $this->db->order_by($this->_primary_key,$this->_ascdesc);

        $this->db->select($select);



        $this->db->from($tabel);

        $q = $this->db->get();

        if ($q->num_rows() > 0) {

            return $q->result();
        } else {

            return false;
        }
    }


    public function cek_hari_libur($date = NULL)
    {


        if ($date != NULL) {
            $result = $this->db->get_where('hari_libur', ['DATE(tanggal_mulai) <=' => date('Y-m-d', strtotime($date)), 'DATE(tanggal_sampai) >=' => date('Y-m-d', strtotime($date))])->row();
            if ($result) {
                return TRUE;;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function latest_code($tabel, $where = NULL, $order)
    {

        if ($where != NULL) {
            foreach ($where as $field => $value) {
                if (is_array($value)) {
                    $this->db->where_in($field, $value);
                } else {
                    $this->db->where($field, $value);
                }
            }
        }
        $this->db->order_by($order, 'DESC');
        $this->db->from($tabel);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }



    public function persetujuan($aktif = true)
    {



        if ($aktif == true) {
            $date = ' AND YEAR(tanggal) = ' . date('Y') . ' AND MONTH(tanggal) = ' . date('m') . ' ';
        } else {
            $date = '';
        }
        $query = '';
        // PRESENSI
        $query .= "SELECT (SELECT COUNT('*') FROM presensi WHERE is_need_approve_in = 'Y' AND checkin_approved = 0 AND deleted = 'N'" . $date . ") + (SELECT COUNT('*') FROM presensi WHERE is_need_approve_out = 'Y' AND checkout_approved = 0 AND deleted_checkout = 'N'" . $date . ") AS presensi,";
        // LEMBUR
        $query .= "(SELECT COUNT('*') AS lembur FROM lembur WHERE approved = 0  AND deleted = 'N'" . $date . ") AS lembur,";
        $query .= "(SELECT COUNT('*') AS rembes FROM rembes WHERE approved = 0  AND deleted = 'N'" . $date . ") AS rembes,";
        $query .= "(SELECT COUNT('*') AS tukar_shift FROM tukar_shift WHERE approved = 1  AND deleted = 'N'" . $date . ") AS tukar_shift,";
        $query .= "(SELECT COUNT('*') AS izin FROM izin WHERE approved = 0  AND deleted = 'N'" . $date . ") AS izin";

        $result = $this->db->query($query)->row();

        return ($result) ? $result : NULL;
    }

    public function get_query($tabel, $query = '')
    {


        $result = $this->db->query($query)->result();

        return ($result) ? $result : NULL;
    }

    public function get_booking($start, $end, $id_product = NULL)
    {
        $where = '';
        if ($id_product != NULL) {
            $where .= 'AND id_product = '.$id_product;
        }
        $data = $this->db->query("SELECT * FROM `booking` WHERE 
        DATE(tanggal_mulai) > '".$start."'
        AND DATE(tanggal_mulai)  <='".$end."'
        AND status  < 3 ".$where."
        OR DATE(tanggal_mulai) <= '".$start."' 
        AND DATE(tanggal_selesai) > '".$end."' 
        AND status  < 3 ".$where."
        OR DATE(tanggal_selesai) > '".$start."' 
        AND DATE(tanggal_selesai) <= '".$end."'
        AND status  < 3 ".$where.";");
        if ($id_product == NULL) {
            return $data->result();
        }else{
            return $data->row();
        }
    }
}
