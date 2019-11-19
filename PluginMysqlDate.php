<?php
class PluginMysqlDate{
  private $settings = null;
  function __construct() {
    wfPlugin::includeonce('wf/array');
    $this->settings = new PluginWfArray(wfPlugin::getPluginModulesOne('mysql/date')->get('settings'));
  }
  public function page_create(){
    if(!wfUser::hasRole('webmaster')){
      exit('Role issue!');
    }
    /**
     * 
     */
    wfPlugin::includeonce('wf/mysql');
    $mysql = new PluginWfMysql();
    $mysql->open($this->settings->get('mysql'));
    $rs = $mysql->runSql('select * from mysql_date order by date;', 'date');
    /**
     * 
     */
    $begin = new DateTime();
    $begin->modify('+1 year');
    $end   = new DateTime();
    $end->modify('-50 year');
    $data = array();
    for($i = $begin; $i >= $end; $i->modify('-1 day')){
      $data[$i->format("Y-m-d")]['value'] = $i->format("Y-m-d");
      $data[$i->format("Y-m-d")]['exist'] = isset($rs['data'][$i->format("Y-m-d")]);
    }
    /**
     * 
     */
    $i = 0;
    foreach ($data as $key => $value) {
      if(!$value['exist']){
        $i++;
        $rs = $mysql->runSql("insert into mysql_date (date) values ('".$value['value']."');", 'date');
      }
    }
    echo "$i poster was created.";
  }
}
