<?php
$link = mysqli_connect("localhost","root","","hotspec");
   // mysqli_select_db('hotspec',$con);

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../style/editor.css" rel="stylesheet" type="text/css">
<script>
  var sLangDir=parent.oUtil.langDir;
  document.write("<scr"+"ipt src='../language/"+sLangDir+"/hyperlink.js'></scr"+"ipt>");
</script>
<script>writeTitle()</script>
<script>

var activeModalWin;

function GetElement(oElement,sMatchTag)
    {
    while (oElement!=null&&oElement.tagName!=sMatchTag)
        {
        if(oElement.tagName=="BODY")return null;
        oElement=oElement.parentNode;
        }
    return oElement;
    }

function doWindowFocus()
    {
    parent.oUtil.onSelectionChanged=new Function("realTime()");
    }

function bodyOnLoad()
    {
    loadTxt();

    window.onfocus=doWindowFocus;
    parent.oUtil.onSelectionChanged=new Function("realTime()");

    if(parent.oUtil.obj.cmdAssetManager!="")
    document.getElementById("btnAsset").style.display="block";
    if(parent.oUtil.obj.cmdFileManager!="")
    document.getElementById("btnAsset").style.display="block";

    realTime()
    }

function bodyOnUnload() {
  parent.oUtil.onSelectionChanged=null;
}

function openAsset()
    {
    if(parent.oUtil.obj.cmdAssetManager!="")
    eval(parent.oUtil.obj.cmdAssetManager);
  if(parent.oUtil.obj.cmdFileManager!="")
    eval(parent.oUtil.obj.cmdFileManager);
    }

function setAssetValue(v)
    {
    document.getElementById("inpURL").value = v;
    }

function modalDialogShow(url,width,height)
    {
    parent.modalDialogShow(url,width,height, window);
    }

function updateList()
    {
    var oEditor=parent.oUtil.oEditor;
    var inpBookmark = document.getElementById("inpBookmark");

    while(inpBookmark.options.length!=0)
        {
        //inpBookmark.options.remove(inpBookmark.options(0))
        inpBookmark.options[0] = null;
        }

    var aNode = oEditor.document.getElementsByTagName("A");
    for(var i=0;i<aNode.length;i++)
        {
        var op = document.createElement("OPTION");
        op.text=aNode[i].name;
        op.value="#"+aNode[i].name;
        inpBookmark.options[inpBookmark.options.length] = op;
        }
    }

function realTime()
    {

    var rdoLinkTo = document.getElementsByName("rdoLinkTo");
    var inpType = document.getElementById("inpType");
    var inpBookmark = document.getElementById("inpBookmark");
    var inpURL = document.getElementById("inpURL");
    var inpTargetCustom = document.getElementById("inpTargetCustom");
    var inpTarget = document.getElementById("inpTarget");
    var inpTitle = document.getElementById("inpTitle");

    var btnInsert = document.getElementById("btnInsert");
    var btnApply = document.getElementById("btnApply");
    var btnOk = document.getElementById("btnOk");

    var oEditor=parent.oUtil.oEditor;

    var oSel = oEditor.getSelection();
    //var oEl = parent.getSelectedElement(oSel);
    var oEl = GetElement(parent.getSelectedElement(oSel),"A");//new

    updateList();

    if(!oEl)//yus
    {
        btnInsert.style.display="block";
        btnApply.style.display="none";
        btnOk.style.display="none";

        inpTarget.value="";
        inpTargetCustom.value="";
        inpTitle.value="";

        inpType.value="";
        inpURL.value="";
        inpBookmark.value="";

        inpBookmark.disabled=true;
        inpURL.disabled=false;
        inpType.disabled=false;
        rdoLinkTo[0].checked=true;
        rdoLinkTo[1].checked=false;
        return;
    }

    //Is there an A element ?
    if (oEl.nodeName == "A")
        {

        var range =oEditor.document.createRange();
        range.selectNode(oEl);
        oSel.removeAllRanges();
        oSel.addRange(range);

        btnInsert.style.display="none";
        btnApply.style.display="block";
        btnOk.style.display="block";


        var sURL = oEl.getAttribute("HREF");

        inpTarget.value="";
        inpTargetCustom.value="";
        var trg = oEl.getAttribute("TARGET");
        if(trg=="_self" || trg=="_blank" || trg=="_parent")
            inpTarget.value=trg;//inpTarget
        else
            inpTargetCustom.value=trg;

        inpTitle.value="";
        if(oEl.getAttribute("TITLE")!=null) inpTitle.value=oEl.getAttribute("TITLE");//inpTitle //1.5.1

    if(sURL==null)sURL="";

        if(sURL.substr(0,7)=="http://")
            {
            inpType.value="http://";//inpType
            inpURL.value=sURL.substr(7);//idLinkURL

            inpBookmark.disabled=true;
            inpURL.disabled=false;
            inpType.disabled=false;
            rdoLinkTo[0].checked=true;
            rdoLinkTo[1].checked=false;
            }
        else if(sURL.substr(0,8)=="https://")
            {
            inpType.value="https://";
            inpURL.value=sURL.substr(8);

            inpBookmark.disabled=true;
            inpURL.disabled=false;
            inpType.disabled=false;
            rdoLinkTo[0].checked=true;
            rdoLinkTo[1].checked=false;
            }
        else if(sURL.substr(0,7)=="mailto:")
            {
            inpType.value="mailto:";
            inpURL.value=sURL.split(":")[1];

            inpBookmark.disabled=true;
            inpURL.disabled=false;
            inpType.disabled=false;
            rdoLinkTo[0].checked=true;
            rdoLinkTo[1].checked=false;
            }
        else if(sURL.substr(0,6)=="ftp://")
            {
            inpType.value="ftp://";
            inpURL.value=sURL.substr(6);

            inpBookmark.disabled=true;
            inpURL.disabled=false;
            inpType.disabled=false;
            rdoLinkTo[0].checked=true;
            rdoLinkTo[1].checked=false;
            }
        else if(sURL.substr(0,5)=="news:")
            {
            inpType.value="news:";
            inpURL.value=sURL.split(":")[1];

            inpBookmark.disabled=true;
            inpURL.disabled=false;
            inpType.disabled=false;
            rdoLinkTo[0].checked=true;
            rdoLinkTo[1].checked=false;
            }
        else if(sURL.substr(0,11).toLowerCase()=="javascript:")
            {
            inpType.value="javascript:";
            //inpURL.value=sURL.split(":")[1];
            inpURL.value=sURL.substr(sURL.indexOf(":")+1);

            inpBookmark.disabled=true;
            inpURL.disabled=false;
            inpType.disabled=false;
            rdoLinkTo[0].checked=true;
            rdoLinkTo[1].checked=false;
            }
        else
            {
            inpType.value="";

            if(sURL.substring(0,1)=="#")
                {
                inpBookmark.value=sURL;
                inpURL.value="";
                inpBookmark.disabled=false;
                inpURL.disabled=true;
                inpType.disabled=true;
                rdoLinkTo[0].checked=false;
                rdoLinkTo[1].checked=true;
                }
            else
                {
                inpBookmark.value=""
                inpURL.value=sURL;
                inpBookmark.disabled=true;
                inpURL.disabled=false;
                inpType.disabled=false;
                rdoLinkTo[0].checked=true;
                rdoLinkTo[1].checked=false;
                }
            }
        }
    else
        {
        btnInsert.style.display="block";
        btnApply.style.display="none";
        btnOk.style.display="none";

        inpTarget.value="";
        inpTargetCustom.value="";
        inpTitle.value="";

        inpType.value="";
        inpURL.value="";
        inpBookmark.value="";

        inpBookmark.disabled=true;
        inpURL.disabled=false;
        inpType.disabled=false;
        rdoLinkTo[0].checked=true;
        rdoLinkTo[1].checked=false;
        }
    }

function applyHyperlink()
    {

    var oEditor=parent.oUtil.oEditor;

    var oSel=oEditor.getSelection();
    var range = oSel.getRangeAt(0);
    parent.oUtil.obj.saveForUndo();

    var rdoLinkTo = document.getElementsByName("rdoLinkTo");
    var inpType = document.getElementById("inpType");
    var inpBookmark = document.getElementById("inpBookmark");
    var inpURL = document.getElementById("inpURL");
    var inpTargetCustom = document.getElementById("inpTargetCustom");
    var inpTarget = document.getElementById("inpTarget");
    var inpTitle = document.getElementById("inpTitle");

    var sURL;
    if(rdoLinkTo[0].checked)
        sURL=inpType.value + inpURL.value;
    else
        sURL=inpBookmark.value;

    if((inpURL.value!="" && rdoLinkTo[0].checked) ||
        (inpBookmark!="" && rdoLinkTo[1].checked))
        {
        var emptySel = false;
        if(document.getElementById("btnInsert").style.display=="block" ||
            document.getElementById("btnInsert").style.display=="")
            {

            if(range.toString()=="")
                { //If no (text) selection, then build selection using the typed URL
                if (range.startContainer.nodeType==Node.ELEMENT_NODE)
                    {
                    if (range.startContainer.childNodes[range.startOffset].nodeType != Node.TEXT_NODE)
                        {
                        if (range.startContainer.childNodes[range.startOffset].nodeName=="BR") emptySel = true; else emptySel=false;
                        }
                        else
                        {
                        emptySel = true;
                        }
                    } else {
                        emptySel = true;
                    }
                }

            if (emptySel)
                {
                var node = oEditor.document.createTextNode(sURL);
                range.insertNode(node);

                range = oEditor.document.createRange();
                range.setStart(node, 0);
                range.setEnd(node, sURL.length);

                oSel = oEditor.getSelection();
                oSel.removeAllRanges();
                oSel.addRange(range);
                }

            }

        oEditor.document.execCommand("CreateLink", false, sURL);

        oSel = oEditor.getSelection();

        var oEl = parent.getSelectedElement(oSel);
        if(oEl)
            {
            if(inpTarget.value=="" && inpTargetCustom.value=="") oEl.removeAttribute("target",0);//target
            else
                {
                if(inpTargetCustom.value!="")
                    oEl.target=inpTargetCustom.value;
                else
                    oEl.target=inpTarget.value;
                }

            if(inpTitle.value=="") oEl.removeAttribute("title",0);//1.5.1
            else oEl.title=inpTitle.value;
            }


        parent.realTime(parent.oUtil.obj);
        parent.oUtil.obj.selectElement(0);
        }
    else
        {
        oEditor.document.execCommand("unlink", false, null);//unlink
        parent.realTime(parent.oUtil.obj);
        parent.oUtil.activeElement=null;
        }
    realTime();
    window.focus();
    }

function changeLinkTo()
    {
    var rdoLinkTo = document.getElementsByName("rdoLinkTo");
    var inpType = document.getElementById("inpType");
    var inpBookmark = document.getElementById("inpBookmark");
    var inpURL = document.getElementById("inpURL");

    if(rdoLinkTo[0].checked)
        {
        inpBookmark.disabled=true;
        inpURL.disabled=false;
        inpType.disabled=false;
        }
    else
        {
        inpBookmark.disabled=false;
        inpURL.disabled=true;
        inpType.disabled=true;
        }
    }
	
	
function showFriendlyUrl(val)
{
	//alert(val)
	document.getElementById("inpURL").value = val;
}
	
	
</script>
</head>
<body style="overflow:hidden;">

<table width=100% height=100% align=center cellpadding=0 cellspacing=0>
<tr>
<td valign=top style="padding:5;">
    <table width=100%>
    <tr>
        <td nowrap>
            <input type="radio" value="url" name="rdoLinkTo" class="inpRdo" checked onClick="changeLinkTo()">
            <span id="txtLang" name="txtLang">Source</span>:
        </td>
        <td width="100%">
            <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td nowrap>
            <select ID="inpType" NAME="inpType" class="inpSel">
                <option value=""></option>
                <option value="http://">http://</option>
                <option value="https://">https://</option>
                <option value="mailto:">mailto:</option>
                <option value="ftp://">ftp://</option>
                <option value="news:">news:</option>
                <option value="javascript:">javascript:</option>
            </select>
            </td>
            <td width="100%"><input type="text" ID="inpURL" NAME="inpURL" style="width:100%" class="inpTxt"></td>
            <td><input type="button" value="" onClick="openAsset()" id="btnAsset" name="btnAsset" style="display:none;background:url('openAsset.gif');width:20px;height:16px;border:#a5acb2 1px solid;margin-left:1px;"></td>
            </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td nowrap>
            <input type="radio" value="bookmark" name="rdoLinkTo" class="inpRdo" onClick="changeLinkTo()">
            <span id="txtLang" name="txtLang">Bookmark</span>:
        </td>
        <td>
        <select name="inpBookmark" id="inpBookmark" class="inpSel" disabled style="width:160px">
        </select></td>
    </tr>

    <tr>
        <td nowrap>
            <span id="txtLang" name="txtLang">Internal Link</span>:
        </td>
        <td>
		<?php 
			$query = mysqli_query($link,"select * from wps_page where status = 1") or die("Error in Query-:".mysql_query());
			
		?>
			<select name="internal_link" id="internal_link" onChange="showFriendlyUrl(this.value)">
		<?php
		$baseurl=$_SERVER['HTTP_HOST'].'/hotspecdemo/';
		
			while($row = $query->fetch_assoc())
			{
				echo '<option value="'.$baseurl.$row["url_key"].'.html">'.$row["title"].'</option>';
				//echo '<option value="'.FriendlyURL($row["cat_name"]).'">'.FriendlyURL($row["cat_name"]).'</option>';
			}	
		?>
			</select>
		
		</td>
    </tr>


    <tr>
        <td nowrap>&nbsp;<span id="txtLang" name="txtLang">Target</span>:</td>
        <td><input type="text" ID="inpTargetCustom" NAME="inpTargetCustom" size=15 class="inpTxt">
        <select ID="inpTarget" NAME="inpTarget" class="inpSel">
            <option value=""></option>
            <option value="_self" id="optLang" name="optLang">Self</option>
            <option value="_blank" id="optLang" name="optLang">Blank</option>
            <option value="_parent" id="optLang" name="optLang">Parent</option>
        </select></td>
    </tr>
    <tr>
        <td nowrap>&nbsp;<span id="txtLang" name="txtLang">Title</span>:</td>
        <td><input type="text" ID="inpTitle" NAME="inpTitle" style="width:160px" class="inpTxt"></td>
    </tr>
    </table>
</td>
</tr>
<tr>
<td class="dialogFooter" align="right">
    <table cellpadding=0 cellspacing=0>
    <tr>
    <td>
    <input type=button name=btnCancel id=btnCancel value="cancel" onClick="self.close()" class="inpBtn" onMouseOver="this.className='inpBtnOver';" onMouseOut="this.className='inpBtnOut'">
    </td>
    <td>
    <input type=button name=btnInsert id=btnInsert value="insert" onClick="applyHyperlink()" class="inpBtn" onMouseOver="this.className='inpBtnOver';" onMouseOut="this.className='inpBtnOut'">
    </td>
    <td>
    <input type=button name=btnApply id=btnApply value="apply" style="display:none" onClick="applyHyperlink()" class="inpBtn" onMouseOver="this.className='inpBtnOver';" onMouseOut="this.className='inpBtnOut'">
    </td>
    <td>
    <input type=button name=btnOk id=btnOk value=" ok " style="display:none;" onClick="applyHyperlink();self.close()" class="inpBtn" onMouseOver="this.className='inpBtnOver';" onMouseOut="this.className='inpBtnOut'">
    </td>
    </tr>
    </table>
</td>
</tr>
</table>

</body>
</html>