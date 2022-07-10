<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Bismillah_Model extends CI_Model{
    public function __construct(){
        $this->load->database() ;
    }

    public function insert_id(){
        return $this->db->insert_id() ;
    }

    public function escape($str){
        return $this->db->escape($str) ;
    }

    public function escape_like_str($str){
        return $this->db->escape_like_str($str) ;
    }

    public function sql_exec($query, $save_log=TRUE, $simple=TRUE){
        if($this->db->save_log === TRUE && $save_log === TRUE){//save to log

        }

        if($simple){
            if(!$this->db->simple_query($query)){
                if(ENVIRONMENT <> 'live'){
                    print_r($this->db->error()) ;
                    print_r($query) ;
                }
            }
        }else{
            if($return = $this->db->query($query)){
                return $return ;
            }else{
                if(ENVIRONMENT <> 'live'){
                    print_r($this->db->error()) ;
                }
            }
        }
    }

    public function select($table, $field, $where='', $join='', $group='', $order='', $limit=''){
        if(trim($where) !== "") $where = 'WHERE ' . $where ;
        if(trim($group) !== "") $group = 'GROUP BY ' . $group ;
        if(trim($order) !== "") $order = 'ORDER BY ' . $order ;
        if(trim($limit) !== "") $limit = 'LIMIT ' . $limit ;

        $query = "SELECT {$field} FROM {$table} {$join} {$where} {$group} {$order} {$limit}" ;
        return $this->sql_exec($query, FALSE, FALSE) ;
    }

    public function getrow($o){
        return $o->unbuffered_row('array') ;
    }

    public function getrow_for($o){
        return $o->result_array() ; 
    }

    public function rows($o){
        return $o->num_rows() ;
    }
    
    public function fields($o){
		return $o->num_fields() ;
	}

    public function insert($table, $data, $save_log=TRUE){
        $field 	= array() ;
        $val 		= array() ;
        foreach ($data as $key => $value) {
            $field[] 	= $key ;
            $val[]		= $this->escape($value) ;
        }
        $field	= "(" . implode(",", $field) . ")" ;
        $val 		= "(" . implode(",", $val) . ")" ;
        $query	= "INSERT INTO {$table} {$field} VALUES {$val}" ;
        echo $this->sql_exec($query, $save_log) ;
    }

    public function edit($table, $data, $where='',$save_log=TRUE){
        if(trim($where) !== "") $where = 'WHERE ' . $where ;

        $udata 			= array() ;
        foreach ($data as $key => $value) {
            $udata[] 	= " {$key} = ".$this->escape($value)." " ;
        }
        $udata 	= implode(", ", $udata) ;
        $query	= "UPDATE {$table} SET {$udata} {$where}" ;
        $this->sql_exec($query, $save_log) ;
    }

    public function update($table, $data, $where='', $field_id='', $save_log=TRUE){
        if($field_id == '') $field_id = 'id';
        $dbdata = $this->select($table, $field_id, $where) ;
        if($this->rows($dbdata) > 0){
            $this->edit($table, $data, $where, $save_log) ;
        }else{
            $this->insert($table, $data, $save_log) ;
        }
    }

    public function delete($table, $where, $save_log=TRUE){
        if(trim($where) !== "") $where = 'WHERE ' . $where ;
        $query 	= "DELETE FROM {$table} {$where}" ;
        $this->sql_exec($query, $save_log) ;
    }

    public function delete_all($table){
        $query 	= "TRUNCATE TABLE {$table}" ;
        $this->sql_exec($query, FALSE) ;
    }

    public function getsql(){
        return $this->db->last_query() ;
    }

    public function getval($field, $where, $table){
        $rerow 		= '' ;
        $dbdata 	= $this->select($table, $field, $where, "", "", "", "0,1") ;
        $row 		= $this->getrow($dbdata) ;
        if(strpos($field, ",") === FALSE && trim($field) !== "*" ){
            if(!empty($row)){
                $rerow 	= $row[$field] ;
            }
        }else{
            $rerow 	= $row ;
        }
        return $rerow ;
    }

    public function saveconfig($key, $val=''){
        $this->update("sys_config", array("title"=>$key, "val"=>$val), "title = " . $this->escape($key), "id") ;
    }

    public function getconfig($key){
        return $this->getval('val', "title = ". $this->escape($key), "sys_config") ;
    }

    public function getincrement($k,$l=true,$n=0 ){
        /*
			$k = Key about increment
			$l = Update increment?
			$n = Length (pad)
		*/
        $inc 	= 1 ;
        $k 	= "inc_" . $k ;
        $val 	= intval($this->getconfig($k)) ;
        $inc 	= ($val > 0) ? $val+1 : $inc ;
        if($l){
            $this->saveconfig($k, $inc) ;
        }
        return str_pad($inc, $n, "0", STR_PAD_LEFT) ;
    }

    public function getlastfaktur($key,$cabang,$tgl,$l=true,$length){
        $tgl = date_2t($tgl);
        $k       = $key .$cabang. date("ymd",$tgl) ;  
        $sisalength = $length - strlen($k);
        return $k . $this->getincrement($k, $l, $sisalength) ; 
    }

    // func DB
    public function AddTable($cTableName,$cSQL,$cDatabase=''){
        if(!empty($cDatabase)){
            $cDatabase = " From " . $cDatabase ;
        }

        //$cTableName = strtolower(trim($cTableName)) ;
        $dbData = $this->db->query("Show Tables $cDatabase") ;
        $lAdd = true ;
        foreach($dbData->result_array() as $dbRow){
            foreach($dbRow as $key){
                if($key == $cTableName){
                    $lAdd = false ; 
                }
            }
        }
        //if($this->rows($dbData) > 0)$lAdd = false ; 
        if($lAdd){
            $this->db->query($cSQL) ;
        }
    }

    function AddField($cTableName,$cFieldName,$cFieldType,$cDefault,$cFieldAfter=''){
        $dbData =  $this->db->query("Show Fields From $cTableName") ;
        $lModif = true ;
        foreach($dbData->result_array() as $dbRow){
            foreach($dbRow as $key){
                if($key == $cFieldName){
                    $lModif = false ; 
                }
            }
        }
        if($lModif){
            if(!empty($cFieldAfter)){
                $cFieldAfter = " AFTER " . $cFieldAfter ;
            }
            $this->db->query("ALTER TABLE $cTableName ADD $cFieldName $cFieldType DEFAULT '$cDefault' $cFieldAfter") ;
        }
    }

    public function CheckDatabase(){
       // $this->AddField("stock","jenis","char(1)","B","stock_group");

        /* $cSQL = "CREATE TABLE `produksi_hasil` (
            `id` double NOT NULL AUTO_INCREMENT,
            `faktur` char(20) DEFAULT NULL,
            `fakturproduksi` char(20) DEFAULT NULL,
            `tgl` date DEFAULT '0000-00-00',
            `cabang` char(4) DEFAULT NULL,
            `gudang` char(4) DEFAULT NULL,
            `stock` char(10) DEFAULT NULL,
            `qty` double(16,2) DEFAULT '0.00',
            `status` char(1) DEFAULT '1',
            `username` varchar(50) NOT NULL DEFAULT '',
            `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (`id`),
            KEY `faktur` (`faktur`),
            KEY `fakturproduksistatus` (`fakturproduksi`,`status`),
            KEY `tglstatus` (`tgl`,`status`),
            KEY `cabtglstatus` (`cabang`,`tgl`,`status`)
            ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1";
        $this->AddTable("produksi_hasil",$cSQL);*/

        $cSQL = "CREATE TABLE `mutasi_stock` (
            `id` double NOT NULL AUTO_INCREMENT,
            `faktur` varchar(20) NOT NULL DEFAULT '',
            `tgl` date NOT NULL DEFAULT '0000-00-00',
            `gudangfrom` varchar(4) NOT NULL DEFAULT '',
            `stockfrom` varchar(20) NOT NULL DEFAULT '',
            `qtyfrom` double(16,2) NOT NULL DEFAULT '0.00',
            `hpfrom` double(16,2) NOT NULL DEFAULT '0.00',
            `gudangto` char(4) NOT NULL DEFAULT '',
            `stockto` varchar(20) NOT NULL DEFAULT '',
            `qtyto` double(16,2) NOT NULL DEFAULT '0.00',
            `hpto` double(16,2) NOT NULL DEFAULT '0.00',
            `status` char(1) NOT NULL DEFAULT '1',
            `username` varchar(50) NOT NULL DEFAULT '',
            `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (`id`),
            KEY `faktur` (`faktur`),
            KEY `fakturstatus` (`faktur`,`status`),
            KEY `tglstatus` (`tgl`,`status`),
            KEY `tglstatusstockfrom` (`tgl`,`status`,`stockfrom`),
            KEY `tglstatusstockto` (`tgl`,`status`,`stockto`)
            ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1";
        //$this->AddTable("mutasi_stock",$cSQL);


        //$this->AddField("po_detail","spesifikasi","varchar(50)","","stock");

    }

}
?>
