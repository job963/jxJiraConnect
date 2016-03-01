<?php
/**
 *    This file is part of the module jxJiraConnect for OXID eShop Community Edition.
 *
 *    The module jxJiraConnect for OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The module jxJiraConnect for OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      https://github.com/job963/jxJiraConnect
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) 2016 Joachim Barthel
 * @author    Joachim Barthel <jobarthel@gmail.com>
 *
 */

class jxjiraconnect_details extends oxAdminDetails {

    protected $_sThisTemplate = "jxjiraconnect_details.tpl";

    /**
     * Displays the latest log entries of selected object
     */
    public function render() 
    {
        parent::render();

        $myConfig = oxRegistry::getConfig();
        
        if ($myConfig->getBaseShopId() == 'oxbaseshop') {
            // CE or PE shop
            $sWhereShopId = "";
        } else {
            // EE shop
            $sWhereShopId = "AND l.oxshopid = {$myConfig->getBaseShopId()} ";
        }
        $blAdminLog = $myConfig->getConfigParam('blLogChangesInAdmin');

        $sObjectId = $this->getEditObjectId();
        
        $this->_jxJiraSearchIssues();
		

        return $this->_sThisTemplate;
    }
    
    
    public function jxJiraConnectCreateIssue() 
    {
        $sIssueSummary = $this->getConfig()->getRequestParameter( 'jxjira_summary' );
        $sIssueDescription = $this->getConfig()->getRequestParameter( 'jxjira_description' );
        //echo $sIssueSummary;
        $sToken = $this->_jxJiraCreateIssue();
    }
    
    
    /*
     * 
     */
    private function _jxJiraSearchIssues() 
    {
        $myConfig = oxRegistry::getConfig();
        
        $sUrl = $myConfig->getConfigParam('sJxJiraConnectServerUrl') . '/rest/api/2/search';
        $sProject = $myConfig->getConfigParam('sJxJiraConnectProject');
        $sUsername = $myConfig->getConfigParam('sJxJiraConnectUser');
        $sPassword = $myConfig->getConfigParam('sJxJiraConnectPassword');
        $sFieldCustomerNumber = 'cf[' . $myConfig->getConfigParam('sJxJiraConnectCustomerNumber') . ']';
        $sFieldCustomerEMail = 'cf[' . $myConfig->getConfigParam('sJxJiraConnectCustomerEMail') . ']';

        $soxId = $this->getEditObjectId();
        if ($soxId != "-1" && isset($soxId)) {
            // load object
            $oOrder = oxNew("oxorder");
            if ($oOrder->load($soxId)) {
                $oUser = $oOrder->getOrderUser();
                $sCustomerNumber = $oUser->oxuser__oxcustnr->value;
                //$sCustomerEMail = $oOrder->oxorder__oxbillemail->value;
            } else {
                $oUser = oxNew("oxuser");
                if ($oUser->load($soxId)) {
                    $sCustomerNumber = $oUser->oxuser__oxcustnr->value;
                }
            }
        }
        $aData = array(
                    'jql' => $sFieldCustomerNumber . ' ~ ' . $sCustomerNumber,
                    'maxResults' => '25'
            );        

        $ch = curl_init();
  
        $aHeaders = array(
            'Accept: application/json',
            'Content-Type: application/json'
            );        

        /*echo '<pre>';
        print_r(json_decode(json_encode($aData),JSON_PRETTY_PRINT));
        echo '</pre>';/**/
  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($aData));
        curl_setopt($ch, CURLOPT_URL, $sUrl);
        curl_setopt($ch, CURLOPT_USERPWD, "$sUsername:$sPassword");

        $result = curl_exec($ch);
        $ch_error = curl_error($ch);

        if ($ch_error) {
            echo "cURL Error: $ch_error";
        } else {
            //echo $result;
            $aResult = json_decode($result,true);
            $iIssueCount = $aResult['total'];
            $aIssues = $aResult['issues'];
            /*echo '<pre>';
            print_r($aIssues);
            echo '</pre>';/**/
            
            $this->_aViewData["sIssueUrl"] = $myConfig->getConfigParam('sJxJiraConnectServerUrl') . '/browse/';
            $this->_aViewData["iIssueCount"] = $iIssueCount;
            $this->_aViewData["aIssues"] = $aIssues;
        }

        curl_close($ch);
        
    }
    
    
    /*
     * 
     */
    private function _jxJiraCreateIssue() 
    {
        $myConfig = oxRegistry::getConfig();
        
        $sUrl = $myConfig->getConfigParam('sJxJiraConnectServerUrl') . '/rest/api/2/issue/';
        $sProject = $myConfig->getConfigParam('sJxJiraConnectProject');
        $sAssignee = $myConfig->getConfigParam('sJxJiraConnectAssignee');
        $sUsername = $myConfig->getConfigParam('sJxJiraConnectUser');
        $sPassword = $myConfig->getConfigParam('sJxJiraConnectPassword');
        $sFieldCustomerNumber = 'customfield_' . $myConfig->getConfigParam('sJxJiraConnectCustomerNumber');
        $sFieldCustomerEMail = 'customfield_' . $myConfig->getConfigParam('sJxJiraConnectCustomerEMail');

        $sIssueSummary = $this->getConfig()->getRequestParameter( 'jxjira_summary' );
        $sIssueDescription = $this->getConfig()->getRequestParameter( 'jxjira_description' );
        $sIssueType = $this->getConfig()->getRequestParameter( 'jxjira_issuetype' );
        $sPriority = $this->getConfig()->getRequestParameter( 'jxjira_priority' );
        $sDueDate = $this->getConfig()->getRequestParameter( 'jxjira_duedate' );

        $soxId = $this->getEditObjectId();
        if ($soxId != "-1" && isset($soxId)) {
            // load object
            $oOrder = oxNew("oxorder");
            if ($oOrder->load($soxId)) {
                $oUser = $oOrder->getOrderUser();
                $sCustomerNumber = $oUser->oxuser__oxcustnr->value;
                $sCustomerEMail = $oOrder->oxorder__oxbillemail->value;
            } else {
                $oUser = oxNew("oxuser");
                if ($oUser->load($soxId)) {
                    $sCustomerNumber = $oUser->oxuser__oxcustnr->value;
                    $sCustomerEMail = $oUser->oxuser__oxusername->value;
                }
            }
        }
        
        $aData = array(
                    'fields' => array(
                        'project' => array(
                            'key' => $sProject,
                            ),
                        'summary' => $sIssueSummary,
                        'description' => $sIssueDescription,
                        $sFieldCustomerNumber => $sCustomerNumber,
                        $sFieldCustomerEMail => $sCustomerEMail,
                        'issuetype' => array(
                            /*"self" => "xxxx",
                            "id" => "xxxx",
                            "description" => "xxxxx",
                            "iconUrl" => "xxxxx",*/
                            'name' => $sIssueType,
                            'subtask' => false
                            ),
                        'assignee' => array(
                            'name' => $sAssignee
                            ),
                        'priority' => array(name => $sPriority),
                        'duedate' => $sDueDate
                        ),
            );        

	/*echo '<pre>';
	print_r(json_encode(json_decode(json_encode($aData)),JSON_PRETTY_PRINT));
	echo '</pre>';*/
        
        $ch = curl_init();
  
        $aHeaders = array(
            'Accept: application/json',
            'Content-Type: application/json'
            );        

        $test = "This is the content of the custom field.";
  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($aData));
        curl_setopt($ch, CURLOPT_URL, $sUrl);
        curl_setopt($ch, CURLOPT_USERPWD, "$sUsername:$sPassword");

        $result = curl_exec($ch);
        $ch_error = curl_error($ch);

        if ($ch_error) {
            echo "cURL Error: $ch_error";
        } else {
            //echo $result;
        }

        curl_close($ch);
        
    }
    
    
}
