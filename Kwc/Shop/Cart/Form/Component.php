<?php
class Kwc_Shop_Cart_Form_Component extends Kwc_Form_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['child']['component']['success'] = false;
        $ret['placeholder']['submitButton'] = trlKwfStatic('Save');
        $ret['viewCache'] = false;
        return $ret;
    }

    public function processInput(array $postData)
    {
        parent::processInput($postData);
        foreach ($this->getData()->parent->getComponent()->getFormComponents() as $form) {
            $form->processInput($postData);
        }
    }

    protected function _initForm()
    {
        $this->_form = new Kwf_Form();
        $this->_form->setModel(new Kwf_Model_FnF());
        foreach ($this->getData()->parent->getComponent()->getFormComponents() as $form) {
            $this->_form->add($form->getForm());
        }
        parent::_initForm();
    }

    public function getTemplateVars()
    {
        $ret = parent::getTemplateVars();
        $ret['form'] = array(); //form-felder nicht nochmal ausgeben
        return $ret;
    }
}
