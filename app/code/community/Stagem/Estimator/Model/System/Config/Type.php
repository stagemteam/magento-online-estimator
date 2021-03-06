<?php
/**
 * @category Popov
 * @package Stagem_Estimator
 * @author Serhii Popov <popow.serhii@gmail.com>
 */

class Stagem_Estimator_Model_System_Config_Type
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $helper = Mage::helper('stagem_estimator');
        $options = [
            Stagem_Estimator_Model_Addon::TYPE_TEXT => $helper->__('Text'),
            Stagem_Estimator_Model_Addon::TYPE_NUMBER => $helper->__('Number'),
            Stagem_Estimator_Model_Addon::TYPE_DATE => $helper->__('Date'),
            Stagem_Estimator_Model_Addon::TYPE_CHECKBOX => $helper->__('Checkbox'),
            Stagem_Estimator_Model_Addon::TYPE_RADIO => $helper->__('Radio Button'),
            Stagem_Estimator_Model_Addon::TYPE_SELECT => $helper->__('Select'),
            Stagem_Estimator_Model_Addon::TYPE_TEXTAREA => $helper->__('Textarea'),
            Stagem_Estimator_Model_Addon::TYPE_INPUT_SELECT => $helper->__('Input-Select'),
        ];

        return $options;
    }
}
