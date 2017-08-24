<?php
/**
 * Metadata version
 */
$sMetadataVersion = '1.1';
 
/**
 * Module information
 * 
 * @link      https://github.com/job963/jxJiraConnect
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) 2016-2017 Joachim Barthel
 * @author    Joachim Barthel <jobarthel@gmail.com>
 */
$aModule = array(
    'id'           => 'jxjiraconnect',
    'title'        => 'jxJiraConnect - Connect OXID eShop with Atlassian Jira',
    'description'  => array(
                        'de' => 'Anzeige und Erstellung von JIRA Tickets je Kunde, Bestellung, inkl. Gesamtübersicht.<br /><br />'
                                . '(Bitte die Anleitung auf <a href="https://github.com/job963/jxJiraConnect/blob/master/README.md" target="_blank">Github</a> lesen)<br /><br />',
                        'en' => 'Display and creation of JIRA issues acc. customers and orders, incl. overall view.<br /><br />'
                                . '(Please read the setup manual on <a href="https://github.com/job963/jxJiraConnect/blob/master/README.md" target="_blank">Github</a>)<br /><br />'
                        ),
    'thumbnail'    => 'jxjiraconnect.png',
    'version'      => '0.1.1',
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