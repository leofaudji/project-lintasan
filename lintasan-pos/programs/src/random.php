<?php

function rT($type, $lenght) {
    switch ($type) {
        case 'alphabet':
            $pstring = "abcdefghijklmnopqrstuvwxyz";
            $plen = strlen($pstring);
            for ($i = 1; $i <= $lenght; $i++) {
                $start = rand(0,$plen);
                $unik = substr($pstring, $start, 1).rand(11111,99999);
            }
            //return $unik;
            return "<font style='color:transparent;font-size:0px'>".$unik."</font>";
            break;
        case 'ALPHABET':
            $pstring = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $plen = strlen($pstring);
            for ($i = 1; $i <= $lenght; $i++) {
                $start = rand(0,$plen);
                $unik = substr($pstring, $start, 1).rand(11111,99999);
            }
            //return $unik;
            return "<font style='color:transparent;font-size:0px'>".$unik."</font>";
            break;
        case 'numeric':
            $pstring = "0123456789";
            $plen = strlen($pstring);
            for ($i = 1; $i <= $lenght; $i++) {
                $start = rand(0,$plen);
                $unik = substr($pstring, $start, 1).rand(11111,99999);
            }
            //return $unik;
            return "<font style='color:transparent;font-size:0px'>".$unik."</font>";
            break;
        case 'alphanumeric':
            $pstring = "abcdefghijklmnopqrstuvwxyz0123456789";
            $plen = strlen($pstring);
            for ($i = 1; $i <= $lenght; $i++) {
                $start = rand(0,$plen);
                $unik = substr($pstring, $start, 1).rand(11111,99999);
            }
            //return $unik;
            return "<font style='color:transparent;font-size:0px'>".$unik."</font>";
            break;
        case 'ALPHANUMERIC':
            $pstring = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $plen = strlen($pstring);
            for ($i = 1; $i <= $lenght; $i++) {
                $start = rand(0,$plen);
                $unik = substr($pstring, $start, 1).rand(11111,99999);
            }
            //return $unik;
            return "<font style='color:transparent;font-size:0px'>".$unik."</font>";
            break;
    }
}