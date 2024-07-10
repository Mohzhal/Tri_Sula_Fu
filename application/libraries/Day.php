<?php 
/**
 * 
 */
class Day{
	var $CI = '';
	function __construct()
	{
		$this->CI = & get_instance();
	}

	public function hari($hariInggris) {

      switch ($hariInggris) {

        case 'Sunday':
          $data = array('hari' => 'Minggu', 'code' => 0);

          return $data;

        case 'Monday':

          $data = array('hari' => 'Senin', 'code' => 1);

          return $data;

        case 'Tuesday':

          $data = array('hari' => 'Selasa', 'code' => 2);

          return $data;

        case 'Wednesday':

          $data = array('hari' => 'Rabu', 'code' => 3);

          return $data;

        case 'Thursday':

          $data = array('hari' => 'Kamis', 'code' => 4);

          return $data;

        case 'Friday':

          $data = array('hari' => 'Jumat', 'code' => 5);

          return $data;

        case 'Saturday':

          $data = array('hari' => 'Sabtu', 'code' => 6);

          return $data;

        default:

          return 'hari tidak valid';

      }
	}
  public function hari_by_code($code) {

      switch ($code) {

        case 7:
          $data = array('hari' => 'Minggu', 'code' => 7);

          return $data;

        case 1:

          $data = array('hari' => 'Senin', 'code' => 1);

          return $data;

        case 2:

          $data = array('hari' => 'Selasa', 'code' => 2);

          return $data;

        case 3:

          $data = array('hari' => 'Rabu', 'code' => 3);

          return $data;

        case 4:

          $data = array('hari' => 'Kamis', 'code' => 4);

          return $data;

        case 5:

          $data = array('hari' => 'Jumat', 'code' => 5);

          return $data;

        case 6:

          $data = array('hari' => 'Sabtu', 'code' => 6);

          return $data;

        default:

          return 'hari tidak valid';

      }
  }
  public function ampm($jam)
  { 
    if (intval(substr($jam,0,2)) < 12) {
      $data = 'AM';
    }else{
      $data = 'PM';
    }
    return $data;
  }
  public function get_all_day(){
    $day = array(
      array('hari' => 'Senin','code' => 1,'warna' => 'danger'),
      array('hari' => 'Selasa', 'code' => 2,'warna' => 'warning'),
      array('hari' => 'Rabu', 'code' => 3,'warna' => 'success'),
      array('hari' => 'Kamis', 'code' => 4, 'warna' => 'primary'),
      array('hari' => 'Jumat', 'code' => 5,'warna' => 'dark'),
      array('hari' => 'Sabtu', 'code' => 6,'warna' => 'info'),
      array('hari' => 'Minggu', 'code' => 7,'warna' => 'secondary')
    );
    return $day;
  }

  public function code_month($month){
    switch ($month) {

        case 'January':
          $data = array('bulan' => 'Januari', 'code' => '01');

          return $data;

        case 'February':

          $data = array('bulan' => 'Februari', 'code' => '02');

          return $data;

        case 'March':

          $data = array('bulan' => 'Maret', 'code' => '03');

          return $data;

        case 'April':

          $data = array('bulan' => 'April', 'code' => '04');

          return $data;

        case 'May':

          $data = array('bulan' => 'Mei', 'code' => '05');

          return $data;

        case 'June':

          $data = array('bulan' => 'Juni', 'code' => '06');

          return $data;

        case 'July':

          $data = array('bulan' => 'Juli', 'code' => '07');

          return $data;

        case 'August':

          $data = array('bulan' => 'Agustus', 'code' => '08');

          return $data;

        case 'September':

          $data = array('bulan' => 'September', 'code' => '09');

          return $data;

        case 'October':

          $data = array('bulan' => 'Oktober', 'code' => '10');

          return $data;

        case 'November':

          $data = array('bulan' => 'November', 'code' => '11');

          return $data;

        case 'December':

          $data = array('bulan' => 'Desember', 'code' => '12');

          return $data;

        default:

          return 'bulan tidak valid';

      }
  }

  public function array_bulan()
  {
    $bulan = array(
        array('bulan' => 'Januari', 'code' => '01'),
        array('bulan' => 'Februari', 'code' => '02'),
        array('bulan' => 'Maret', 'code' => '03'),
        array('bulan' => 'April', 'code' => '04'),
        array('bulan' => 'Mei', 'code' => '05'),
        array('bulan' => 'Juni', 'code' => '06'),
        array('bulan' => 'Juli', 'code' => '07'),
        array('bulan' => 'Agustus', 'code' => '08'),
        array('bulan' => 'September', 'code' => '09'),
        array('bulan' => 'Oktober', 'code' => '10'),
        array('bulan' => 'November', 'code' => '11'),
        array('bulan' => 'Desember', 'code' => '12')
    );

    return $bulan;
  }

}
?>