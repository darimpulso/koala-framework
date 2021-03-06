<?php
abstract class Kwf_View_Helper_Abstract_MailLink extends Kwf_Component_View_Helper_Abstract
{
    // wenn encoding geändert wird, auch bei decoding ändern !!
    // decoding in Kwf_js/MailDecode.js
    private $_atEncoding = '(kwfat)';
    private $_dotEncoding = '(kwfdot)';

    // wird zB in LinkTag_Mail_Data.php verwendet, deshalb public
    public function encodeMail($address)
    {
        if ($this->_getRenderer() instanceof Kwf_Component_Renderer_Mail) {
            return $text;
        }
        $address = trim($address);
        $address = preg_replace('/^(.+)@(.+)\.([^\.\s]+)$/i',
            '$1'.$this->_atEncoding.'$2'.$this->_dotEncoding.'$3',
            $address
        );
        return $address;
    }

    public function encodeText($text)
    {
        if ($this->_getRenderer() instanceof Kwf_Component_Renderer_Mail) {
            return $text;
        }
        $text = preg_replace('/(^|[\s<>])([^@\s<>]+)@([^@\s]+)\.([^\.\s<>]+)($|[\s<>])/',
            '$1<span class="kwfEncodedMail">$2'.$this->_atEncoding.'$3'.$this->_dotEncoding.'$4</span>$5',
            $text
        );
        return $text;
    }
}
