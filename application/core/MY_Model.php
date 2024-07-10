<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class MY_Model extends CI_Model
{



	protected $_table_name = '';

	protected $_primary_key = '';

	protected $_primary_filter = 'intval';

	protected $_order_by = '';

	protected $_ascdesc = 'asc';

	public $rules = array();



	function __construct()
	{

		parent::__construct();

		$this->load->database();
	}



	public function get($id = NULL, $single = FALSE)
	{



		if ($id != NULL) {

			$filter = $this->_primary_filter;

			$id = $filter($id);

			$this->db->where($this->_primary_key, $id);

			$method = 'row';
		} elseif ($single == TRUE) {

			$method = 'row';
		} else {

			$method = 'result';
		}



		if (!inicompute($this->db->order_by($this->_order_by))) {

			$this->db->order_by($this->_order_by);
		}

		return $this->db->get($this->_table_name)->$method();
	}



	function get_order_by($array = NULL, $limit = 20, $start = 0)
	{

		if ($array != NULL) {

			if ($limit > 0) {

				if ($start > 0) {

					$this->db->limit($limit, $start);
				} else {

					$this->db->limit($limit);
				}
			}

			$this->db->from($this->_table_name);
			foreach ($array as $field => $value) {
				if (is_array($value)) {
					$this->db->where_in($field, $value);
				} else {
					$this->db->where($field, $value);
				}
			}
			$this->db->order_by($this->_order_by);

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

			$this->db->from($this->_table_name)->order_by($this->_order_by);

			$query = $this->db->get();

			return $query->result();
		}
	}



	function get_all($array)
	{

		if ($array != NULL) {

			$this->db->from($this->_table_name)->where($array)->order_by($this->_order_by, $this->_ascdesc);
		} else {

			$this->db->from($this->_table_name)->order_by($this->_order_by, $this->_ascdesc);
		}

		$query = $this->db->get();

		return $query->result();
	}



	function get_single($array = NULL)
	{

		if ($array != NULL) {

			$this->db->select()->from($this->_table_name)->where($array);

			$query = $this->db->get();

			return $query->row();
		} else {

			$this->db->select()->from($this->_table_name)->order_by($this->_order_by);

			$query = $this->db->get();

			return $query->result();
		}
	}



	function insert($array)
	{

		$this->db->insert($this->_table_name, $array);

		$id = $this->db->insert_id();

		return $id;
	}



	function update($data, $id = NULL)
	{

		$filter = $this->_primary_filter;

		$id = $filter($id);

		$this->db->set($data);

		$this->db->where($this->_primary_key, $id);

		return $this->db->update($this->_table_name);
	}



	public function delete_batch($arrays)
	{

		if (count($arrays)) {

			$this->db->where_in($this->_primary_key, $arrays);

			$this->db->delete($this->_table_name);

			return TRUE;
		} else {

			return FALSE;
		}
	}



	public function delete($id)
	{

		$filter = $this->_primary_filter;

		$id = $filter($id);



		if (!$id) {

			return FALSE;
		}

		$this->db->where($this->_primary_key, $id);

		$this->db->limit(1);

		return $this->db->delete($this->_table_name);
	}



	public function hash($string)
	{

		return hash("sha512", $string . config_item("encryption_key"));
	}



	public function makeArrayWithTableName($array, $tableName = NULL)

	{

		if (is_null($tableName)) {

			$tableName = $this->_table_name;
		}

		$ar = [];

		foreach ($array as $key => $a) {

			$relation = explode('.', $key);

			if (inicompute($relation) == 1) {

				$ar[$tableName . '.' . $key] = $a;
			} else {

				$ar[$key] = $a;
			}
		}

		return $ar;
	}



	function get_where_in($arrays, $key = NULL, $whereArray = NULL)
	{

		if (inicompute($arrays)) {

			if ($key == NULL) {

				$this->db->where_in($this->_primary_key, $arrays);
			} else {

				$this->db->where_in($key, $arrays);
			}



			if ($whereArray != NULL) {

				$this->db->where($whereArray);
			}



			$query = $this->db->get($this->_table_name);

			return $query->result();
		} else {

			return [];
		}
	}



	public function get_where_params($where = null, $select = "*", $params = array())
	{



		//       if ($where != NULL){

		//           $this->db->where($where);

		// }

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

		if (isset($params['wherein']) && !empty($params['wherein'])) {

			if (count($params['wherein']) > 0) {
				foreach ($params['wherein'] as $kolom => $array) {
					$this->db->where_in($kolom, $array);
				}
			}
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

			$this->db->order_by($params['arroderby']['kolom'], $params['arrorderby']['order']);
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


		if (isset($params['limit'])) {

			if (isset($params['offset'])) {

				$this->db->limit($params['limit'], $params['offset']);
			} else {

				$this->db->limit($params['limit']);
			}
		}




		// $this->db->order_by($this->_primary_key,$this->_ascdesc);

		$this->db->select($select);



		$this->db->from($this->_table_name);

		$q = $this->db->get();

		if ($q->num_rows() > 0) {

			return $q->result();
		} else {

			return false;
		}
	}



	public function get_cnt_where_params($where = null, $params = array())
	{



		if ($where != NULL) {

			$this->db->where($where);
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



		if (isset($params['arrjoin'])) {



			foreach ($params['arrjoin'] as $table => $statement) {

				$type = (isset($statement['type']) && $statement['type'] != '') ? $statement['type'] : 'INNER';



				$this->db->join($table, $statement['statement'], $type);
			}
		}



		$this->db->from($this->_table_name);

		return $this->db->count_all_results();
	}
}
