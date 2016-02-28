            
                [{if $oxid != "-1" }]
                <iframe src="[{$oViewConf->getSelfLink()}]&cl=jxjiraconnect_issuecount&jxcustomerno=[{$edit->oxuser__oxcustnr->value}]" width="100%" height="28" 
                        frameborder="0" scrolling="no" name="jxjiraconnect_issuecount" align="left" style="margin-left:-20px; border: 1px none blue;">
                </iframe><br clear="all" />
                [{/if}]
                
[{$smarty.block.parent}]
