<?php  
class Files{
	var $CI;
    var $id_sekolah = "";
    public function __construct()
	{
        $this->CI = & get_instance();
        $this->id_sekolah = $this->CI->session->userdata('lms_id_sekolah_siswa');
    }
    public function size($file){
         $a = array("B", "KB", "MB", "GB", "TB", "PB");
        $pos = 0;
        $size = filesize($file);
        while ($size >= 1024)
        {
            $size /= 1024;
            $pos++;
        }
        return round ($size,2)." ".$a[$pos];
    }

    public function duration($file){

        if (file_exists($file)){
             ## open and read video file
            $handle = fopen($file, "r");
            ## read video file size
            $contents = fread($handle, filesize($file));

            fclose($handle);
            $make_hexa = hexdec(bin2hex(substr($contents,strlen($contents)-3)));

            if (strlen($contents) > $make_hexa){

                $pre_duration = hexdec(bin2hex(substr($contents,strlen($contents)-$make_hexa,3))) ;
                $post_duration = $pre_duration/1000;
                $timehours = $post_duration/3600;
                $timeminutes =($post_duration % 3600)/60;
                $timeseconds = ($post_duration % 3600) % 60;
                $timehours = explode(".", $timehours);
                $timeminutes = explode(".", $timeminutes);
                $timeseconds = explode(".", $timeseconds);
                $duration = $timehours[0]. ":" . $timeminutes[0];}
                return $duration;

            }
            else {
                return false;
            }
        }
    public function get_id_yt_by_url($url)
    {
        if (strpos($url,"watch?v=")) {
           $bagian = parse_url($url); // parsekan url link youtube menjadi bagian-bagian 
            parse_str($bagian['query'], $parameter);// mengambil bagian query atau parameter
            $id_youtube =  $parameter['v']; //mengambil parameter v dari variable $parameter
        }else{
            $array = explode ("/",$url);
            $id_youtube = $array[3];
        }

        return $id_youtube;
    }
    public function duration_youtube($youtube_time)
    {
        if($youtube_time) {
            $start = new DateTime('@0'); // Unix epoch
            $start->add(new DateInterval($youtube_time));
            $youtube_time = $start->format('H:i:s');
        }
        
        return $youtube_time;
    }
    public function get_CURL($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }
}
?>