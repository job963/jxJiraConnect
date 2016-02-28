            [{*<div style="font-weight:bold;color:red;background-color:#ffeeee;border:1px solid red;padding:2px;margin-bottom:6px;border-radius:3px;">
            &nbsp;Ticket(s) offen f&uuml;r diesen Kunden&nbsp;
            </div>*}]
            [{*<div style="width:100%;border: 1px solid blue;">*}]
            
                [{assign var="user" value=$edit->getOrderUser() }]
                <iframe src="[{$oViewConf->getSelfLink()}]&cl=jxjiraconnect_issuecount&jxcustomerno=[{$user->oxuser__oxcustnr->value}]" width="100%" height="28" 
                        frameborder="0" [{*scrolling="no"*}] name="jxjiraconnect_issuecount" align="left" style="margin-left:-20px; border: 1px none blue;">
                </iframe><br clear="all" />
                
            [{*</div>*}]
            
[{$smarty.block.parent}]
