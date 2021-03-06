<?php
/**
 * @category Stagem
 * @package Stagem_Estimator
 * @author Serhii Popov <popow.serhii@gmail.com>
 */
class Stagem_Estimator_Block_Adminhtml_Addon_Grid extends Mage_Adminhtml_Block_Widget_Grid {

	protected function _construct() {
		parent::_construct();

		// set some defaults for our grid
		$this->setDefaultSort('id');
		$this->setId('stagem_addon_grid');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection() {
		/** @var Stagem_Estimator_Model_Resource_Addon_Collection $collection */
		$collection = Mage::getModel('stagem_estimator/addon')->getCollection();

		/*$collection->getSelect()
			->joinLeft(array('category' => $collection->getTable('catalog/category')), 'main_table.category_id = category.entity_id', array(
				'category.parent_id',
				'category.path'
			));*/

		/*foreach ($collection as $view) {
			if ($view->getStoreId() && $view->getStoreId() != 0) {
				$view->setStoreId(explode(',', $view->getStoreId()));
			} else {
				$view->setStoreId(array('0'));
			}
		}*/

		$this->setCollection($collection);

		return parent::_prepareCollection();
	}

	protected function _prepareColumns() {
		$this->addColumn('id', array(
			'header' => $this->__('ID'),
			'index'  => 'id',
			'align'  =>'right',
			'width'  => '10px',
		));

        $this->addColumn('type', array(
            'header' => $this->__('Type'),
            'index'  => 'type'
        ));

		$this->addColumn('name', array(
			'header' => $this->__('Name'),
			'index'  => 'name'
		));

        $this->addColumn('price_condition', array(
            'header' => $this->__('Price Cond.'),
            'index'  => 'price_condition'
        ));

		/*$this->addColumn('category_id', array(
			'header'   => $helper->__('Category'),
			'index'    => 'category_id',
			'type'     => 'options',
			'options'  => Mage::getModel('Stagem_Estimator_Model_System_Config_Category')->toOptionArray(),
			'renderer' => 'Stagem_Estimator_Block_Widget_Grid_Column_Renderer_Category',
		));*/

		if (!Mage::app()->isSingleStoreMode()) {
			$this->addColumn('store_id', array(
				'header' => $this->__('Store View'),
				'index' => 'store_id',
				'type' => 'store',
				'store_all' => true,
				'store_view' => true,
				'sortable' => true,
				'filter_condition_callback' => array($this, '_filterStoreCondition'),
			));
		}

		$this->addColumn('created_at', array(
			'header' => $this->__('Created date'),
			'type'   => 'datetime',
			'index'  => 'created_at'
		));

		$this->addColumn('updated_at', array(
			'header' => $this->__('Updated date'),
			'type'   => 'datetime',
			'index'  => 'updated_at'
		));

		$this->addColumn('is_active', array(
			'header'    => $this->__('Status'),
			'index'     => 'is_active',
			'type'      => 'options',
			'options'   => array(
				1 => $this->__('Enabled'),
				0 => $this->__('Disabled')
			),
		));

		$this->addColumn('action', array(
			'header'    => $this->__('Action'),
			'width'     => '60',
			'type'      => 'action',
			'getter'    => 'getId',
			'actions'   => array(
				array(
					'caption' => $this->__('Edit'),
					'url'     => array('base' => '*/*/edit'),
					'field'   => 'id'
				),
			),
			'filter'    => false,
			'sortable'  => false,
			'index'     => 'stores',
			'is_system' => true,
		));

		return parent::_prepareColumns();
	}

	protected function _filterStoreCondition($collection, $column) {
		if (!$value = $column->getFilter()->getValue()) {
			return;
		}
		$this->getCollection()->addStoreFilter($value);
	}

	/**
	 * This is where our row data will link to
	 *
	 * @param $model
	 * @return string
	 */
	public function getRowUrl($model) {
		return $this->getUrl('*/*/edit', array(
			'id' => $model->getId(),
		));
	}

}
