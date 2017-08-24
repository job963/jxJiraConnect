[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign }]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

[{assign var="cssFilePath" value=$oViewConf->getModulePath('jxjiraconnect','out/admin/src/jxjiraconnect.css') }]
[{php}] 
    $sCssFilePath = $this->get_template_vars('cssFilePath');;
    $sCssTime = filemtime( $sCssFilePath );
    $this->assign('cssTime', $sCssTime);
[{/php}]
[{assign var="cssFileUrl" value=$oViewConf->getModuleUrl('jxjiraconnect','out/admin/src/jxjiraconnect.css') }]
[{assign var="cssFileUrl" value="$cssFileUrl?$cssTime" }]
<link href="[{$cssFileUrl}]" type="text/css" rel="stylesheet">
[{assign var="imgIconUrl" value=$oViewConf->getModuleUrl('jxjiraconnect','out/admin/src/img') }]


<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="jx_voucherserie_show">
</form>


    [{*$iIssueCount*}]
    <div id="liste" style="border:0px solid gray; padding:4px; width:99%; height:45%; overflow-y:scroll;">
            <table cellspacing="0" cellpadding="0" border="0" width="99%">
                <tr>
                    <td class="listheader">&nbsp;[{ oxmultilang ident="JXJIRA_STATUSICON" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JXJIRA_KEY" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JXJIRA_SUMMARY" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JXJIRA_PRIORITY" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JXJIRA_STATUS" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JXJIRA_CREATED" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JXJIRA_CREATOR" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JXJIRA_DUEDATE" }]</td>
                </tr>
                [{foreach item=aIssue from=$aIssues}]
                    [{ cycle values="listitem,listitem2" assign="listclass" }]
                    <tr>
                        <td class="[{ $listclass }]" style="height: 20px;">&nbsp;<img src="[{$aIssue.fields.issuetype.iconUrl}]" /></td>
                        <td class="[{ $listclass }]"><a href="[{$sIssueUrl}][{$aIssue.key}]" target="_blank">[{$aIssue.key}]</a></td>
                        <td class="[{ $listclass }]" title="[{$aIssue.fields.description|escape:'html'}]"><a href="[{$sIssueUrl}][{$aIssue.key}]" title="[{$aIssue.fields.description|escape:'html'}]" target="_blank">[{$aIssue.fields.summary|escape:'html'}]</a></td>
                        <td class="[{ $listclass }]"><img src="[{$imgIconUrl}]/priority[{$aIssue.fields.priority.id}].png" /> [{ oxmultilang ident="JXJIRA_PRIORITY_"|cat:$aIssue.fields.priority.id }]</td>
                        <td class="[{ $listclass }]"><span class="jira-status-[{$aIssue.fields.status.statusCategory.colorName}]">&nbsp;[{$aIssue.fields.status.name}]&nbsp;</span></td>
                        <td class="[{ $listclass }]">[{$aIssue.fields.created|substr:0:10}]</td>
                        <td class="[{ $listclass }]">[{$aIssue.fields.creator.displayName|escape:'html'}]</td>
                        <td class="[{ $listclass }]">[{$aIssue.fields.duedate}]</td>
                    </tr>
                [{/foreach}]
            </table>
    </div>
            
    <div style="height:20px;">&nbsp;</div>
    
    <div>
        <form name="jxjiraconnect_createissue" id="jxjiraconnect_details" action="[{ $oViewConf->getSelfLink() }]" method="post">
            [{ $oViewConf->getHiddenSid() }]
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            <input type="hidden" name="cl" value="jxjiraconnect_details">
            <input type="hidden" name="fnc" value="jxJiraConnectCreateIssue">
            <table>
                <tr>
                    <td>[{ oxmultilang ident="JXJIRA_SUMMARY" }]</td><td>
                        <input type="text" name="jxjira_summary" size="50" />
                        <select name="jxjira_issuetype" width="20">
                            <option value="Purchase">[{ oxmultilang ident="JXJIRA_ISSUETYPE_PURCHASE" }]</option>
                            <option value="Bug">[{ oxmultilang ident="JXJIRA_ISSUETYPE_BUG" }]</option>
                            <option value="Access">[{ oxmultilang ident="JXJIRA_ISSUETYPE_ACCESS" }]</option>
                            <option value="Fault">[{ oxmultilang ident="JXJIRA_ISSUETYPE_FAULT" }]</option>
                            <option value="Task">[{ oxmultilang ident="JXJIRA_ISSUETYPE_TASK" }]</option>
                        </select>
                        <select name="jxjira_priority" width="20">
                            <option value="Blocker">[{ oxmultilang ident="JXJIRA_PRIORITY_1" }]</option>
                            <option value="Critical">[{ oxmultilang ident="JXJIRA_PRIORITY_2" }]</option>
                            <option value="Major" selected>[{ oxmultilang ident="JXJIRA_PRIORITY_3" }]</option>
                            <option value="Minor">[{ oxmultilang ident="JXJIRA_PRIORITY_4" }]</option>
                            <option value="Trivial">[{ oxmultilang ident="JXJIRA_PRIORITY_5" }]</option>
                        </select>
                    </td>
                </tr><tr>
                    <td valign="top">[{ oxmultilang ident="JXJIRA_DESCRIPTION" }]</td><td><textarea cols="80" rows="3" name="jxjira_description"></textarea></td>
                </tr><tr>
                    <td>[{ oxmultilang ident="JXJIRA_DUEDATE" }]</td><td><input type="text" name="jxjira_duedate" size="10" /></td>
                </tr>
                </tr><tr>
                    <td></td><td><input type="submit" /></td>
                </tr>
            </table>
        </form>
    </div>

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]
