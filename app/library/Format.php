<?php namespace App\liblary;
class Format
{
    /**
     * @param get rp
     * @return string
     */
    public static function getRp($bilangan)
    {
        $minus = "";
        if ($bilangan < 0) {
            $minus = "-";
        }
        return $minus . 'Rp' . self::getThousandSeparator(abs($bilangan));
    }
    public static function getThousandSeparator($bilangan)
    {
       if (is_numeric($bilangan)) {
           return number_format($bilangan, 0, ',', '.');
       }
       return 0;
    }

    public static function convertMonth($param){

        $listMonth = [
            '1'=>'Januari',
            '2'=>'Februari',
            '3'=>'Maret',
            '4'=>'April',
            '5'=>'Mei',
            '6'=>'Juni',
            '7'=>'Juli',
            '8'=>'Agustus',
            '9'=>'Oktober',
            '10'=>'November',
            '11'=>'September',
            '12'=>'Desember'
        ];
        return $listMonth[$param];

    }

}
