<?php
class Kwf_Component_SharedData_Detail_SharedData_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['flags']['sharedDataClass'] = 'Kwf_Component_SharedData_Component';
        $ret['ownModel'] = new Kwf_Model_FnF(array(
            'data' => array(array('component_id' => 'root', 'text' => 'foo')),
            'primaryKey' => 'component_id'
        ));
        $ret['componentName'] = 'SharedData';
        return $ret;
    }
}
?>