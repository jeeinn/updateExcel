<?php
/**
 * Created by PhpStorm.
 * User: jeeinn
 * Date: 16-5-24
 * Time: 上午11:04
 */

return array(
    'WHICH_TABLE'       => 'sample',//数据库表名称
    'WHICH_TABLE_COL'   => 'name',//条件表字段名，如id，name
    'TARGET_TABLE_COL'  => 'sex',//目标表字段名
    'FILE_NAME'         => 'list.xlsx',//相对于根目录的文件名
    'START_ROW'         => '2',//表格数据从第几行有效
    'READ_CELL_COL'     => 'A',//读取的列名称，比如A、B、C
    'ROW_COUNT'         => '0',//读取的行数量，0为不限制
    'WRITE_CELL_COL'    => 'B',//写入的列名称，比如A、B、C
);