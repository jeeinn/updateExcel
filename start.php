<?php
/**
 * Created by PhpStorm.
 * User: jeeinn
 * Date: 16-5-24
 * Time: 上午10:01
 */


require_once './Classes/PHPExcel.php';

/**
 * 连接数据库
 */
$db_config = require_once './common/db.php';
$dns=$db_config['DB_TYPE'].':dbname='.$db_config['DB_NAME'].';host='.$db_config['DB_HOST'];
$options = array(
    PDO::ATTR_AUTOCOMMIT=>true,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8';",
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
);
try {
    $pdo = new PDO($dns, $db_config['DB_USER'], $db_config['DB_PWD'], $options);
}catch (PDOException  $e){
    echo "Error: ".$e;
}
/**
 * 读取文件配置
 */
$config = require_once './common/config.php';
$file_name = $config['FILE_NAME'];
$table = $config['WHICH_TABLE'];

/**
 * 处理xls
 */
$objPHPExcel =  \PHPExcel_IOFactory::load($file_name);
$outputFileName = date('YmdHms').'_'.$file_name;
$workSheet = $objPHPExcel->getActiveSheet();
//获取行数，并把数据读取出到$data数组
$rowCount=$workSheet->getHighestRow();//excel行数
//echo $rowCount;

for($i=$config['START_ROW'];$i<=$rowCount;$i++){
    $cellValue = $workSheet->getCell($config['READ_CELL_COL'].$i)->getValue();
    $res = $pdo->query("select * from {$config['WHICH_TABLE']} WHERE {$config['WHICH_TABLE_COL']}='$cellValue'");
    foreach ($res as $row) {
        $workSheet->getCell($config['WRITE_CELL_COL'].$i)->setValue(iconv('gbk','utf-8',$row[$config['TARGET_TABLE_COL']])) or die('设置单元格数据失败'.$config['WRITE_CELL_COL'].$i);
    }
}

/**
 * 实例化Excel写入类
 */
$PHPWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$PHPWriter->save($outputFileName);
echo "ok!\r\nfile:$outputFileName";
