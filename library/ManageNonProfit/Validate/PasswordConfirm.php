<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ManageNonProfit_Validate_PasswordConfirm extends Zend_Validate_Abstract
{
    const NOT_MATCH = 'notMatch';
 
    protected $_messageTemplates = array(
        self::NOT_MATCH => 'Password confirmation does not match'
    );
 
    public function isValid($value, $context = null)
    {
        $value = (string) $value;
        $this->_setValue($value);
 
        if (is_array($context)) {
            if (isset($context['password_confirm'])
                && ($value == $context['password_confirm']))
            {
                return true;
            }
        } elseif (is_string($context) && ($value == $context)) {
            return true;
        }
 
        $this->_error(self::NOT_MATCH);
        return false;
    }
}
