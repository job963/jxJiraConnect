<?php
/**
 * Metadata version
 */
$sMetadataVersion = '1.1';
 
/**
 * Module information
 */
$aModule = array(
    'id'           => 'jxjiraconnect',
    'title'        => 'jxJiraConnect - Connect OXID eShop with Atlassian Jira',
    'description'  => array(
                        'de' => 'Anzeige der protokollierten Admin Aktionen an jedem Objekt und als Gesamtbericht.<br /><br />'
                                . '(um das Logging zu aktivieren muss in der Datei config.inc.php die Einstellung<br />'
                                . '<code>$this->blLogChangesInAdmin = false;</code> auf <code>True</code> geändert werden)<br /><br />',
                        'en' => 'Display of Logged Administrative Actions for each Object and as full Report.<br /><br />'
                                . '(for enabling the logging you have to change the setting<br />'
                                . '<code>$this->blLogChangesInAdmin = false;</code> to <code>True</code>)<br /><br />'
                        ),
    'thumbnail'    => 'jxjiraconnect.png',
    'version'      => '0.1',
    'author'       => 'Joachim Barthel',
    'url'          => 'https://github.com/job963/jxJiraConnect',
    'email'        => 'jobarthel@gmail.com',
    'extend'       => array(
                        ),
    'files'        => array(
                        'jxjiraconnect_allopen'     	=> 'jxmods/jxjiraconnect/application/controllers/admin/jxjiraconnect_allopen.php',
                        'jxjiraconnect_issuecount'     	=> 'jxmods/jxjiraconnect/application/controllers/admin/jxjiraconnect_issuecount.php',
                        'jxjiraconnect_details' 	=> 'jxmods/jxjiraconnect/application/controllers/admin/jxjiraconnect_details.php'/*,
                        'jxjiraconnect_events' 	=> 'jxmods/jxjiraconnect/core/jxjiraconnect_events.php'*/
                        ),
    'templates'    => array(
                        'jxjiraconnect_allopen.tpl'     => 'jxmods/jxjiraconnect/application/views/admin/tpl/jxjiraconnect_allopen.tpl',
                        'jxjiraconnect_issuecount.tpl'  => 'jxmods/jxjiraconnect/application/views/admin/tpl/jxjiraconnect_issuecount.tpl',
                        'jxjiraconnect_details.tpl'     => 'jxmods/jxjiraconnect/application/views/admin/tpl/jxjiraconnect_details.tpl'
                        ),
    'blocks'       => array(
                        array(
                            'template' => 'user_main.tpl', 
                            'block'    => 'admin_user_main_form',                     
                            'file'     => '/out/blocks/admin_user_main_form.tpl'
                          ),
                        array(
                            'template' => 'order_overview.tpl', 
                            'block'    => 'admin_order_overview_billingaddress',                     
                            'file'     => '/out/blocks/admin_order_overview_billingaddress.tpl'
                          ),
                        ),
    'events'       => array(/*
                        'onActivate'   => 'jxjiraconnect_events::onActivate', 
                        'onDeactivate' => 'jxjiraconnect_events::onDeactivate'
                        */),
    'settings' => array(
                        array(
                                'group' => 'JXJIRACONNECT_SERVER', 
                                'name'  => 'sJxJiraConnectServerUrl', 
                                'type'  => 'str', 
                                'value' => ''
                                ),
                        array(
                                'group' => 'JXJIRACONNECT_LOGIN', 
                                'name'  => 'sJxJiraConnectUser', 
                                'type'  => 'str', 
                                'value' => ''
                                ),
                        array(
                                'group' => 'JXJIRACONNECT_LOGIN', 
                                'name'  => 'sJxJiraConnectPassword', 
                                'type'  => 'str', 
                                'value' => ''
                                ),
                        array(
                                'group' => 'JXJIRACONNECT_DEFAULTS', 
                                'name'  => 'sJxJiraConnectProject', 
                                'type'  => 'str', 
                                'value' => ''
                                ),
                        array(
                                'group' => 'JXJIRACONNECT_DEFAULTS', 
                                'name'  => 'sJxJiraConnectAssignee', 
                                'type'  => 'str', 
                                'value' => ''
                                ),
                        array(
                                'group' => 'JXJIRACONNECT_FIELDS', 
                                'name'  => 'sJxJiraConnectCustomerNumber', 
                                'type'  => 'str', 
                                'value' => ''
                                ),
                        array(
                                'group' => 'JXJIRACONNECT_FIELDS', 
                                'name'  => 'sJxJiraConnectCustomerEMail', 
                                'type'  => 'str', 
                                'value' => ''
                                )
                        )
);