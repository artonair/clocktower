var newWin = null;  
function popUpAIR(strURL, strType, strHeight, strWidth) {  
 if (newWin != null && !newWin.closed)  
   newWin.close();  
 var strOptions="";  
 if (strType=="console")  
   strOptions="resizable,height="+  
     strHeight+",width="+strWidth;  
 if (strType=="fixed")  
   strOptions="status=no,menubar=no,toolbar=no,location=no,top=150,left=200, height="+  
     strHeight+",width="+strWidth;
 if (strType=="elastic")  
   strOptions="toolbar,menubar,scrollbars,"+  
     "resizable,location,height="+  
     strHeight+",width="+strWidth;  
 newWin = window.open(strURL, 'newWin', strOptions);  
 newWin.focus();  
}


