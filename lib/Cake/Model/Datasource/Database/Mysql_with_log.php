App::import('Core', array('Model', 'datasource', 'dbosource', 'dbomysql'));

class DboMysqlWithLog extends DboMysql {
    function _execute($sql) {
        $this->log($sql, 'queries');
        return parent::_execute($sql);
    }
}