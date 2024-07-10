<?php  
class Self{
	var $CI;
    var $id_sekolah = "";
    public function __construct()
	{
        $this->CI = & get_instance();
        $this->id_sekolah = $this->CI->session->userdata('lms_id_sekolah_siswa');
    }
    public function user($id_siswa){
        $query = "SELECT siswa.id_siswa,siswa.id_sekolah,siswa.nis,siswa.nisn,siswa.nama AS nama_siswa,siswa.password,siswa.gender,alamat,telp,email,foto,thumb,last_access,aktif,jurusan.nama AS nama_jurusan,tingkat.nama AS nama_tingkat, kelas.nama AS nama_kelas,tahun_ajaran.nama AS nama_tahun_ajaran,kelas.id_tingkat AS tingkatan, kelas.id_kelas FROM siswa LEFT JOIN peserta_kelas ON siswa.id_siswa = peserta_kelas.id_siswa LEFT JOIN kelas ON kelas.id_kelas = peserta_kelas.id_kelas LEFT JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran LEFT JOIN tingkat ON tingkat.id_tingkat = kelas.id_tingkat LEFT JOIN jurusan ON jurusan.id_jurusan = kelas.id_jurusan WHERE siswa.id_siswa = $id_siswa AND siswa.id_sekolah = $this->id_sekolah";
        $data = $this->CI->db->query($query);
        return $data->row();
    }
   
}
?>