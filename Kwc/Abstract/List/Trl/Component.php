<?php
class Kwc_Abstract_List_Trl_Component extends Kwc_Chained_Trl_Component
{
    public static function getSettings($masterComponentClass)
    {
        $ret = parent::getSettings($masterComponentClass);
        $ret['componentIcon'] = new Kwf_Asset('page');
        $ret['generators']['child']['class'] = 'Kwc_Abstract_List_Trl_Generator';
        $ret['childModel'] = 'Kwc_Abstract_List_Trl_Model';

        $ret['assetsAdmin']['files'][] = 'kwf/Kwc/Abstract/List/Trl/FullSizeEditPanel.js';
        $ret['assetsAdmin']['dep'][] = 'KwfAutoGrid';
        $ret['assetsAdmin']['dep'][] = 'KwfComponent';

        $ret['extConfig'] = 'Kwc_Abstract_List_Trl_ExtConfigList';

        return $ret;
    }

    public function getTemplateVars()
    {
        $ret = parent::getTemplateVars();
        $children = $this->getData()->getChildComponents(array('generator' => 'child'));

        // wird zweimal gesetzt. siehe kommentar in nicht-trl component
        $ret['children'] = $children;
        $childrenById = array();
        foreach ($children as $c) {
            $childrenById[$c->id] = $c;
        }
        foreach (array_keys($ret['listItems']) as $k) {
            $id = $ret['listItems'][$k]['data']->id;
            if (isset($childrenById[$id])) {
                $ret['listItems'][$k]['data'] = $childrenById[$id];
            } else {
                unset($ret['listItems'][$k]);
            }
        }
        return $ret;
    }

    public function hasContent()
    {
        $childComponents = $this->getData()->getChildComponents(array('generator' => 'child'));
        foreach ($childComponents as $c) {
            if ($c->hasContent()) return true;
        }
        return false;
    }

    public function getExportData()
    {
        $ret = array('list' => array());
        $children = $this->getData()->getChildComponents(array('generator' => 'child'));
        foreach ($children as $child) {
            $ret['list'][] = $child->getComponent()->getExportData();
        }
        return $ret;
    }
}
