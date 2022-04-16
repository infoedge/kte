<?php


/**
 * Description of Useful
 *
 * @author Apache1
 */
namespace common\components;

//use Yii;
use yii\base\Component;

class Useful extends Component {
    /**
     * Prepends any string with zeros until NoOfchars is reached
     * Returns string
     */
    public function x_digit($str_in, $NoOfChars){
        if (strlen(trim((string)$str_in)) < $NoOfChars){
            $str_out=  trim((string)$str_in);
            $startCnt = strlen($str_out);
            for($i=$startCnt;$i<$NoOfChars;$i++){
                $str_out='0' .$str_out;
            }
        }else{// str_in is longer than NoOfChars therefore take least significant charachters
            $str_out = substr($str_in,-$NoOfChars);
        }
        return $str_out;
    }
    
    /*
     * returns a date
     */
    public function lastMonthDate($datein /* yyyymm*/){
        $spacer='-';
        $myyear= substr($datein,0,4);
        $mymonth =substr($datein,-2);
        $myday = '01';
        $themonth=(((int)$mymonth)+1);
        $mymonth=$this->x_digit((string)$themonth,2);
        if(($themonth)>12 ){
            $myyear=(string)(((int)$myyear)+1);
            $mymonth = "01";
        }
        $firstDateNext=$myyear.$spacer.$mymonth.$spacer.$myday;
        $mydate =  date_create($firstDateNext);
        date_modify($mydate,"-1 day");
        return (date_format($mydate,'Y-m-d'));
    }
    
    
    public function monthDate($dateIn/* assumes format yyyy/mm/dd */){
        
        return substr($dateIn,0,4). substr($dateIn,5,2);//format yyyymm
    }
    
    public function prevMonthLastDate($dateIn/* assumes format yyyymm */){
        //$thedate=date_parse($dateIn);
        $spacer='-';
        $thedate= substr($dateIn, 0,4).$spacer.substr($dateIn,5, 2).$spacer.'01';
        //$thedate= substr($dateIn, 0,4).substr($dateIn, -2).$spacer.'01';
        //$mydate= $thedate['year'].$spacer.$thedate['month'].$spacer.'01';
        /*$date = date_create('2000-01-01');
        date_add($date, date_interval_create_from_date_string('10 days'));
        echo date_format($date, 'Y-m-d');*/
        // Each set of intervals is equal.
        //$i = new DateInterval('P1D');
        //$i = DateInterval::createFromDateString('1 day');
        //$mydate =  date_create($thedate);
        $mydate =  new \DateTime($thedate);
        date_add($mydate ,date_interval_create_from_date_string('-1 day'));
        return (date_format($mydate,'Y-m-d'));
        /*$date = new \DateTime($thedate);
        $date->add(new \DateInterval('P-1D'));
        return $date->format('Y-m-d');*/
    }
    public function min($x,$y){
        return $x>$y?$y:$x;
    }
    public function max($x,$y){
        return $x<$y?$y:$x;
    }
    public function addDateInterval($theDate/* Format yyyy-mm-dd hh:ii:ss*/, $interval/* In Days*/,$outFormat=1){
        $mydate = new \DateTime($theDate);
         $mydate->modify($interval. ' days');
         switch($outFormat){
             case 1:
                 return $mydate->format('Y-m-d H:i:s');
             case 2:
                 return $mydate->format('Y-m-d');
         }
         
    }
    public function getRandomStr($length)
    {
        //$length = 10;    
        return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
    }
    
    
    public function makePureAlphaNum($strIn)
    {
        $strout = "";
        for($i=0;$i< strlen($strIn);$i++){
            if(ctype_alnum(substr($strIn, $i,1))){
                $strout.= substr($strIn, $i,1);
            }
        }
        return $strout;
    }
    
    function force_download_a_file($dl_file)
    {
            if(is_file($dl_file))
            {
                    if(ini_get('zlib.output_compression')) { 
                                    ini_set('zlib.output_compression', 'Off');	
                    }
                    header('Expires: 0');
                    header('Pragma: public'); 
                    header('Cache-Control: private',false);
                    header('Content-Type: application/force-download');
                    header('Content-Disposition: attachment; filename="'.basename($dl_file).'"');
                    header('Content-Transfer-Encoding: binary');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($dl_file)).' GMT');
                    header('Content-Length: '.filesize($dl_file));
                    header('Connection: close');
                    readfile($dl_file);
                    die();
            }
    }
}
