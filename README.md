# updateExcel
一个通过比对数据表内容，来更新本地excel内容的小工具
应用场景：
根据excel表中A2-A20中的shop_id,在数据库查找对应的信息创建时间，并相应的写在E2-E20中；
步骤：
1.把excel放在根目录，文件名假设为：list.xlsx
2.设置配置文件(common/config.php)和要连接的数据库(common.db.php)：

    'WHICH_TABLE'       => 'shop',//数据库表名称
    'WHICH_TABLE_COL'   => 'shop_id',//条件表字段名，如id，name
    'TARGET_TABLE_COL'  => 'create_time',//目标表字段名
    'FILE_NAME'         => 'list.xlsx',//相对于根目录的文件名
    'START_ROW'         => '2',//表格数据从第几行有效
    'READ_CELL_COL'     => 'A',//读取的列名称，比如A、B、C
    'ROW_COUNT'         => '19',//读取的行数量，0为不限制
    'WRITE_CELL_COL'    => 'E',//写入的列名称，比如A、B、C
    
3.执行start.php
