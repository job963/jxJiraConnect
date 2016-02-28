[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]


<style>
    #liste tr:hover td{
        background-color: #e0e0e0;
    }

    #liste td.activetime {
        background-image: url(bg/ico_activetime.png);
        min-width: 17px;
        background-position: center center;
        background-repeat: no-repeat;
    }
    .listitem, .listitem2 {
        padding-left: 4px;
        padding-right: 16px;
        white-space: nowrap;
    }
    .jira-status-medium-gray {
        color: dimgray;
        border: 1px solid gray;
        border-radius: 3px;
    }
    .jira-status-yellow {
        color: darkgoldenrod;
        border: 1px solid goldenrod;
        border-radius: 3px;
    }
    .jira-status-green {
        color: green;
        border: 1px solid green;
        border-radius: 3px;
    }
    .jira-status-brown {
        color: saddlebrown;
        border: 1px solid brown;
        border-radius: 3px;
    }
    .jira-status-warm-red {
        color: firebrick;
        border: 1px solid crimson;
        border-radius: 3px;
    }
    .jira-status-blue-gray {
        color: royalblue;
        border: 1px solid cornflowerblue;
        border-radius: 3px;
    }
</style>


<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="jx_voucherserie_show">
</form>


<div style="height:92%;">

    [{*$iIssueCount*}]
    <div id="liste" style="border:0px solid gray; padding:4px; width:99%; height:95%; overflow-y:scroll; float:left;">
        [{*if $blAdminLog == FALSE }]
            <div style="border:2px solid #dd0000;margin:10px;padding:5px;background-color:#ffdddd;font-family:sans-serif;font-size:14px;">
                <b>Setting <i>blLogChangesInAdmin</i> in <i>config.inc.php</i> is deactivated!</b><br />Actually no new admin action will be logged.
            </div>
        [{/if*}]
        <form name="jxadminlog_history" id="jxadminlog_history" action="[{ $oViewConf->getSelfLink() }]" method="post">
            [{ $oViewConf->getHiddenSid() }]
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            <input type="hidden" name="cl" value="jxadminlog">
            <input type="hidden" name="fnc" value="">
            [{*<input type="hidden" name="voucherdelid" value="">*}]
            <table cellspacing="0" cellpadding="0" border="0" width="99%">
                <tr>
                    <td class="listheader">&nbsp;[{ oxmultilang ident="JXJIRA_STATUSICON" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JXJIRA_KEY" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JXJIRA_SUMMARY" }]</td>
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
                        <td class="[{ $listclass }]" title="[{$aIssue.fields.description}]"><a href="[{$sIssueUrl}][{$aIssue.key}]" title="[{$aIssue.fields.description}]" target="_blank">[{$aIssue.fields.summary}]</a></td>
                        <td class="[{ $listclass }]"><span class="jira-status-[{$aIssue.fields.status.statusCategory.colorName}]">&nbsp;[{$aIssue.fields.status.name}]&nbsp;</span></td>
                        <td class="[{ $listclass }]">[{$aIssue.fields.created|substr:0:10}]</td>
                        <td class="[{ $listclass }]">[{$aIssue.fields.creator.displayName}]</td>
                        <td class="[{ $listclass }]">[{$aIssue.fields.duedate}]</td>
                    </tr>
                [{/foreach}]
            </table>
        </form>
            
        <br />

        <form name="jxjiraconnect_details" id="jxjiraconnect_details" action="[{ $oViewConf->getSelfLink() }]" method="post">
            [{ $oViewConf->getHiddenSid() }]
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            <input type="hidden" name="cl" value="jxjiraconnect_details">
            <input type="hidden" name="fnc" value="jxJiraConnectCreateIssue">
            <table>
                <tr>
                    <td>Summary</td><td><input type="text" name="jxjira_summary" size="80" /></td>
                </tr><tr>
                    <td>Description</td><td><textarea cols="80" rows="5" name="jxjira_description"></textarea></td>
                </tr>
                </tr><tr>
                    <td></td><td><input type="submit" /></td>
                </tr>
            </table>
        </form>
    </div>

    <div style="float:right;[{*position:relative;bottom:-40px;*}]padding-right:10px;">
    [{*<br />
            <a href="https://github.com/job963/jxAdminLog" target="_blank"><span style="color:gray;">jxAdminLog</span></a>
    </div>*}]

</div>

[{*include file="bottomnaviitem.tpl"*}]
[{include file="bottomitem.tpl"}]

