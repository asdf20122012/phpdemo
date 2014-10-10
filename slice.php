slice :

<?php 
$input = array("a", "b", "c", "d", "e");
$output = array_slice($input, 0,2);      // returns "a", "b"
$output= array_merge($output,array_slice($input, 2+1));  // returns "d","e"
var_dump($output );



/**
 * 全概率计算
 *
 * @param array $p array('a'=>0.5,'b'=>0.2,'c'=>0.4)
 * @return string 返回上面数组的key
 */
function random($ps){
    static $arr = array();
    $key = md5(serialize($ps));  
     if (!isset($arr[$key])) {
        $max = array_sum($ps);
        foreach ($ps as $k=>$v) {
            $v = $v / $max * 10000;
            for ($i=0; $i<$v; $i++) $arr[$key][] = $k;
        }
    }
    return $arr[$key][mt_rand(0,count($arr[$key])-1)];
}   


function get_rand($proArr) { 
    $result = '';   
     //概率数组的总概率精度
    $proSum = array_sum($proArr);  
     //概率数组循环
    foreach ($proArr as $key => $proCur) { 
        $randNum = mt_rand(1, $proSum); 
        if ($randNum <= $proCur) { 
            $result = $key; 
            break; 
        } else { 
            $proSum -= $proCur; 
        } 
    } 
    unset ($proArr);  
     return $result; 
} 

$prize_arr = array( 
    '0' => array('id'=>1,'prize'=>'平板电脑','v'=>1), 
    '1' => array('id'=>2,'prize'=>'数码相机','v'=>5), 
    '2' => array('id'=>3,'prize'=>'音箱设备','v'=>10), 
    '3' => array('id'=>4,'prize'=>'4G优盘','v'=>12), 
    '4' => array('id'=>5,'prize'=>'10Q币','v'=>22), 
    '5' => array('id'=>6,'prize'=>'下次没准就能中哦','v'=>50), 
);



//如果中奖数据是放在数据库里，这里就需要进行判断中奖数量
//在中1、2、3等奖的，如果达到最大数量的则unset相应的奖项，避免重复中大奖
//code here eg:unset($prize_arr['0'])
foreach ($prize_arr as $key => $val) { 
    $arr[$val['id']] = $val['v']; 
}   
 $rid = get_rand($arr); //根据概率获取奖项id 
 $res['yes'] = $prize_arr[$rid-1]['prize']; //中奖项
//将中奖项从数组中剔除，剩下未中奖项，如果是数据库验证，这里可以省掉
unset($prize_arr[$rid-1]); 
shuffle($prize_arr); //打乱数组顺序
for($i=0;$i<count($prize_arr);$i++){ 
    $pr[] = $prize_arr[$i]['prize']; 
} 
$res['no'] = $pr; 
echo json_encode($res); 
?>
