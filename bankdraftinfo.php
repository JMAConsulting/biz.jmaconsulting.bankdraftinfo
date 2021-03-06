<?php

require_once 'bankdraftinfo.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function bankdraftinfo_civicrm_config(&$config) {
  _bankdraftinfo_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function bankdraftinfo_civicrm_xmlMenu(&$files) {
  _bankdraftinfo_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function bankdraftinfo_civicrm_install() {
  _bankdraftinfo_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function bankdraftinfo_civicrm_uninstall() {
  _bankdraftinfo_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function bankdraftinfo_civicrm_enable() {
  _bankdraftinfo_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function bankdraftinfo_civicrm_disable() {
  _bankdraftinfo_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function bankdraftinfo_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _bankdraftinfo_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function bankdraftinfo_civicrm_managed(&$entities) {
  _bankdraftinfo_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function bankdraftinfo_civicrm_caseTypes(&$caseTypes) {
  _bankdraftinfo_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function bankdraftinfo_civicrm_angularModules(&$angularModules) {
_bankdraftinfo_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function bankdraftinfo_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _bankdraftinfo_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_postProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postProcess
 */
function bankdraftinfo_civicrm_postProcess($formName, &$form) {
  if ($formName == "CRM_Contribute_Form_Contribution_Confirm") {

    // Check if payment processor is ACHEFT
    $pp = CRM_Core_DAO::singleValueQuery("SELECT class_name FROM civicrm_payment_processor WHERE id = {$form->_params['payment_processor_id']}");
    if ($pp == "Payment_iATSServiceACHEFT") {
      $fields = array(
        "bank_account_number" => "Bank_Account_Number",
        "cad_bank_number" => "Bank_Institution_Number",
        "cad_transit_number" => "Branch_Transit_Number",
      );
      foreach ($fields as $key => $value) {
        if (!empty($form->_params[$key])) {
          $fid = civicrm_api3('CustomField', 'getvalue', array(
            'return' => "id",
            'name' => $value,
          ));
          civicrm_api3('CustomValue', 'create', array(
            'entity_id' => $form->_contactID,
            'custom_' . $fid => $form->_params[$key],
          ));
        }
      }
    }
  }
}
/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function bankdraftinfo_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function bankdraftinfo_civicrm_navigationMenu(&$menu) {
  _bankdraftinfo_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'biz.jmaconsulting.bankdraftinfo')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _bankdraftinfo_civix_navigationMenu($menu);
} // */
