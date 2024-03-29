<?php

/**
 * Transaction form base class.
 *
 * @package    zapnacrm
 * @subpackage form
 * @author     Your name here
 */
class BaseTransactionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'amount'                => new sfWidgetFormInput(),
      'description'           => new sfWidgetFormInput(),
      'order_id'              => new sfWidgetFormPropelChoice(array('model' => 'CustomerOrder', 'add_empty' => true)),
      'customer_id'           => new sfWidgetFormPropelChoice(array('model' => 'Customer', 'add_empty' => true)),
      'transaction_status_id' => new sfWidgetFormPropelChoice(array('model' => 'EntityStatus', 'add_empty' => false)),
      'created_at'            => new sfWidgetFormDateTime(),
      'agent_company_id'      => new sfWidgetFormInput(),
      'commission_amount'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorPropelChoice(array('model' => 'Transaction', 'column' => 'id', 'required' => false)),
      'amount'                => new sfValidatorNumber(),
      'description'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'order_id'              => new sfValidatorPropelChoice(array('model' => 'CustomerOrder', 'column' => 'id', 'required' => false)),
      'customer_id'           => new sfValidatorPropelChoice(array('model' => 'Customer', 'column' => 'id', 'required' => false)),
      'transaction_status_id' => new sfValidatorPropelChoice(array('model' => 'EntityStatus', 'column' => 'id')),
      'created_at'            => new sfValidatorDateTime(),
      'agent_company_id'      => new sfValidatorInteger(array('required' => false)),
      'commission_amount'     => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transaction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transaction';
  }


}
