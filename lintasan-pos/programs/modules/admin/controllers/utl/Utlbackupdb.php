<?php
class Utlbackupdb extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("utl/Utlbackupdb_m") ;
        $this->bdb 	= $this->Utlbackupdb_m ;
    } 

    public function index(){
        $this->load->view("utl/utlbackupdb") ; 

    }



    public function backup(){
        $pathtmp=APPPATH.'../tmp/';
        $nama_database =  'backup-on-'. date("Y-m-d-H-i-s") .'.sql';
        $simpan = $pathtmp.$nama_database;
        $file = "./tmp/".$nama_database;

        $this->bdb->db->query("SET NAMES 'utf8'");
        //get all of the tables
        $tables = array();
            $result = $this->bdb->db->query("SHOW TABLES");
            //echo($result);
            while($row = $this->bdb->getrow($result)){
                $n =0 ;
                foreach($row as $ky => $val){
                    if($n == 0)$tables[] = $row[$ky];
                    $n++;
                }


            }


        $return = '';
        //cycle through
        foreach($tables as $table)
        {
        $result4 = $this->bdb->db->query('SELECT * FROM `'.$table.'`');
        $num_fields = $this->bdb->fields($result4);
        $num_rows = $this->bdb->rows($result4);

        $return.= 'DROP TABLE IF EXISTS `'.$table.'`;';
        $ct = $this->bdb->db->query('SHOW CREATE TABLE `'.$table.'`');

        //struktur tabel
        if($row2 = $this->bdb->getrow($ct)){
            //print_r($row2);
            if($row2['Create Table'] <> "")$return.= "\n\n".$row2['Create Table'].";\n\n";
        }

            $counter = 1;
            $n = 1;
            //Over tables
            for ($i = 0; $i < $num_fields; $i++) 
            {   //Over rows
                while($row = $this->bdb->getrow($result4))
                {   

                    if($counter == 1 || $n == 1){
                        $return.= 'INSERT INTO `'.$table.'` VALUES(';
                    } else{
                        $return.= '(';
                    }

                    //Over fields
                    $j =0;
                    foreach($row as $ky => $val){
                        $row[$ky] = addslashes($row[$ky]);
                        $row[$ky] = str_replace("\n","\\n",$row[$ky]);
                        if (isset($row[$ky])) { $return.= '"'.$row[$ky].'"' ; } else { $return.= '""'; }
                        if ($j<($num_fields-1)) { $return.= ','; }
                        $j++;
                    }

                    if($num_rows == $counter || $n == 3000){
                        $return.= ");\n";
                        $n = 0;
                    } else{
                        $return.= "),\n";
                    }
                    ++$counter;
                    ++$n;
                }
            }
            $return.="\n\n\n";
        }

        $handle = fopen($file,'w+');
        fwrite($handle,$return);
        echo('
            var a = document.getElementById("linkdownlaodbackup");
            document.getElementById("linkdownlaodbackup").href = "'.$file.'" ;
            a.innerHTML = "'.$nama_database.'";
        ');
    }
}
?>

