<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */

    public static function getReport($i)
            {
        $query = "
    select MONTHNAME(tgl_income) AS BLN, MONTH(tgl_income) AS BLNNUMBER, income.kd_anggota as kda, jml_income,  outc.jml_outcome,
jml_income - outc.jml_outcome as total
from (
    select *, sum(jml_income) as income
    from t_income  as ti
    where MONTH(ti.tgl_income) = '".$i."'
    GROUP BY YEAR(ti.tgl_income), MONTH(ti.tgl_income) DESC
) as income 
LEFT JOIN (
    select *, sum(t_o.jml_outcome) as outcome
    from t_outcome  as t_o
    where MONTH(t_o.tgl_outcome) = '".$i."'
    GROUP BY YEAR(t_o.tgl_outcome), MONTH(t_o.tgl_outcome) DESC) as outc on  outc.kd_anggota =  income.kd_anggota ";                       
        $listData = \DB::select($query);
        return $listData;
    }
   
}
