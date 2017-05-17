<?php
class Helpers
{
    /**
     * for set menu
     * @param  integer $parent [description]
     * @return [type]          [description]
     */
    public static function getMenu($parent = 0)
    {
        $user_grp = Session::get('user_grp');
        $menu = self::queryMenu($user_grp, $parent);
        $data = array();
        foreach ($menu as $row) {
            $data[] = array(
                    'id_menu'        =>$row['id_menu'],
                    'name_menu'        =>$row['name_menu'],
                    'url_menu'        =>$row['url_menu'],
                    'icon_menu'        =>$row['icon_menu'],
                    // recursive
                    'child'            =>self::getMenu($row['id_menu'])
                );
        }
        return $data;
    }
    /**
     * for set menu
     * @param  integer $parent [description]
     * @return [type]          [description]
     */
    public static function getMenuAll($parent = 0)
    {
        $user_grp = Session::get('user_grp');
        $menu = self::queryMenuAll($user_grp, $parent);
        $data = array();
        foreach ($menu as $row) {
            $data[] = array(
                    'id_menu'        =>$row['id_menu'],
                    'name_menu'        =>$row['name_menu'],
                    'url_menu'        =>$row['url_menu'],
                    // recursive
                    'child'            =>self::getMenuAll($row['id_menu'])
                );
        }
        return $data;
    }
    /**
     * set query menu
     * @param  [type] $user_grp [description]
     * @param  [type] $parent   [description]
     * @return [type]           [description]
     */
    private static function queryMenu($user_grp, $parent)
    {


        $query = "select * from menu_admin as ma
                    where ma.parent_menu  = '".$parent."' and
                    id_menu IN (select id_menu from menu_role where user_grp='".$user_grp."')";

        $menu = DB::select($query);
        $data = collect($menu)->map(function ($x) {
            return (array) $x;
        })->toArray();
        return $data;
    }

    /**
     * set query menu
     * @param  [type] $user_grp [description]
     * @param  [type] $parent   [description]
     * @return [type]           [description]
     */
    private static function queryMenuAll($user_grp, $parent)
    {
        $query = "select * from menu_admin as ma
                    where ma.parent_menu  = '".$parent."'";
        $menu = DB::select($query);
        $data = collect($menu)->map(function ($x) {
            return (array) $x;
        })->toArray();
        return $data;
    }

    public static function printRecursiveList($data)
    {
        $str = "";
        foreach ($data as $list) {
            if(!empty($list['icon_menu'])){
                $icon  = $list['icon_menu'];
            } else {
                $icon = 'list';
            }
            if (!empty($list['child'])) {
            $str .= '<li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">'.$icon.'</i>
                               <span>'.$list['name_menu'].'</span>
                           </a>';
            } else {
                $str .= '<li>
                            <a href="'.url($list['url_menu']).'">
                            <i class="material-icons">'.$icon.'</i>
                               <span>'.$list['name_menu'].'</span>
                           </a>';
            }

            $subchild = self::printRecursiveList($list['child']);
            if (!empty($subchild)) {
                $str .= '<ul class="ml-menu" >
							'.$subchild.'
						</ul>';
            }
            $str .= '</li>';
        }
        return $str;
    }
    public static function printRecursiveListMenu($data)
    {
        $str = "";
        foreach ($data as $list) {
            if (!empty($list['child'])) {
                $str .= '<li>
                            <a href="#" onclick="setMenu('.$list['id_menu'].', \''.$list['name_menu'].'\')" class="menu-toggle">
                               <span>'.$list['name_menu'].'</span>
                           </a>';
            } else {
                $str .= '<li>
                            <a onclick="setMenu('.$list['id_menu'].', \''.$list['name_menu'].'\')"  >
                               <span>'.$list['name_menu'].'</span>
                           </a>';
            }

            $subchild = self::printRecursiveListMenu($list['child']);
            if (!empty($subchild)) {
                $str .= '<ul class="ml-menu" >
                            '.$subchild.'
                        </ul>';
            }
            $str .= '</li>';
        }
        return $str;
    }

    public static function printRecursiveListMenuCheked($data, $selectedArray)
    {
        $str = "";
        foreach ($data as $list) {
            $checked  = self::in_array_r($list['id_menu'], $selectedArray);
            $ck = "";
            if ($checked) {
                $ck = "checked='checked'";
            }
            if (!empty($list['child'])) {
                $str .= '<li>
                            <a href="#" onclick="setMenu('.$list['id_menu'].', \''.$list['name_menu'].'\')" >
                              '.$list['name_menu'].' <input type="checkbox" '.$ck.' value="'.$list['id_menu'].'" name="id_menu[]" class="filled-in">
                           </a>';
            } else {
                $str .= '<li>'.$list['name_menu'].'<input type="checkbox"  value="'.$list['id_menu'].'" name="id_menu[]"  '.$ck.'  />';
            }

            $subchild = self::printRecursiveListMenuCheked($list['child'], $selectedArray);
            if (!empty($subchild)) {
                $str .= '<ul>
                            '.$subchild.'
                        </ul>';
            }
            $str .= '</li>';
        }
        return $str;
    }
    private static function in_array_r($id_menu, $selectedArray){
        if(array_search($id_menu, array_column($selectedArray, 'id_menu')) !== False) {
            return true;
        } else {
            return false;
        }
    }

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

        $listMonth = self::getMonth();
        return $listMonth[$param];
    }
    public static function getMonth(){
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
        return $listMonth;
    }
    /**
     * @param get rp
     * @return string
     */
    public static function getFavicon()
    {
        $query = "select * from settings where setting_name = 'favicon' ";
        $menu = DB::select($query);
        return !empty($menu[0]->value) ? $menu[0]->value : "";
    }
}
