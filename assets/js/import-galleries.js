function print_Msg(e,t){var n=document.createElement("div");"notice"!=t&&"warning"!=t&&"error"!=t||(n.className="message-entry",n.className+="notice"==t?" notice-message":"warning"==t?" warning-message":" error-message"),n.innerHTML=e,document.getElementById("Msg-container").prepend(n)}function preventPOST(e){e.preventDefault()}function get_inputValue(e){var t=document.getElementById(e);return""==t.value?null:t.value}function get_credentials(){var e={DBHostExport:get_inputValue("database-host-ex"),DBNameExport:get_inputValue("database-name-ex"),DBUserExport:get_inputValue("database-user-ex"),DBPassExport:get_inputValue("database-pass-ex"),DBNameImport:get_inputValue("database-name-im"),DBUserImport:get_inputValue("database-user-im"),DBPassImport:get_inputValue("database-pass-im"),StartID:get_inputValue("start-from-id")};for(var t in e)return null==e[t]?(print_Msg("please fill out "+t+" field.","error"),1):e}function getPHPHandlerLocation(e){for(var t,n=/(\S+)import-galerii\//g,o=document.location.href;null!==(t=n.exec(o));){t.index===n.lastIndex&&n.lastIndex++;return t[1]+"wp-content/themes/zs-hroznova/template-parts/php-import-content-handlers/"+e}}function checkConnectionsToDBs(e){connectionCheckRequest=new XMLHttpRequest;var t=getPHPHandlerLocation("db-connection-test.php"),n="DBNameExport="+encodeURIComponent(e.DBNameExport)+"&";return n+="DBUserExport="+encodeURIComponent(e.DBUserExport)+"&",n+="DBPassExport="+encodeURIComponent(e.DBPassExport)+"&",n+="DBNameImport="+encodeURIComponent(e.DBNameImport)+"&",n+="DBUserImport="+encodeURIComponent(e.DBUserImport)+"&",n+="DBPassImport="+encodeURIComponent(e.DBPassImport),connectionCheckRequest.open("POST",t,!1),connectionCheckRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),connectionCheckRequest.send(n),200===connectionCheckRequest.status?JSON.parse(connectionCheckRequest.responseText):(console.log("Status code returned from db-connection-test.php: "+connectionCheckRequest.status),1)}function countPicturesToProcess(e){connectionCountPics=new XMLHttpRequest;var t=getPHPHandlerLocation("get-number-of-images.php"),n="DBNameExport="+encodeURIComponent(e.DBNameExport)+"&";return n+="DBUserExport="+encodeURIComponent(e.DBUserExport)+"&",n+="DBPassExport="+encodeURIComponent(e.DBPassExport)+"&",n+="StartPictureID="+encodeURIComponent(e.StartPictureID),connectionCountPics.open("POST",t,!1),connectionCountPics.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),connectionCountPics.send(n),200===connectionCountPics.status?JSON.parse(connectionCountPics.responseText):(console.log("Status code returned from get-number-of-images.php: "+connectionCountPics.status),1)}function importPicture(e,t){connectionImportPic=new XMLHttpRequest;var n=getPHPHandlerLocation("image-handler.php"),o="DBNameExport="+encodeURIComponent(t.DBNameExport)+"&";return o+="DBUserExport="+encodeURIComponent(t.DBUserExport)+"&",o+="DBPassExport="+encodeURIComponent(t.DBPassExport)+"&",o+="DBHostExport="+encodeURIComponent(t.DBHostExport)+"&",o+="PictureID="+encodeURIComponent(e),connectionImportPic.open("POST",n,!1),connectionImportPic.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),connectionImportPic.send(o),200===connectionImportPic.status?connectionImportPic.responseText:(console.log("Status code returned from get-number-of-images.php: "+connectionImportPic.status),1)}function setupProgressBar(e,t){var n=document.getElementById(e);n.className+=" import-button-progress-bar",n.childNodes[0].nextSibling.innerHTML="Importing . . . (0/"+t+")";var o=document.createElement("div");o.id="progress-line",document.getElementById(e).prepend(o),n.removeEventListener("click",importHandler),n.addEventListener("click",preventPOST)}function importHandler(e){e.preventDefault();var t=get_credentials();if(1==t)return console.log("couldn't contiue after trying to get credentials."),1;var n=checkConnectionsToDBs(t);1==n.ExDBCon?print_Msg("error occured connection to Export database: "+n.ExException,"error"):1==n.ImDBCon?print_Msg("error occured connection to Import database: "+n.ImException,"error"):print_Msg("Connections established.","notice");var o=countPicturesToProcess(t);-1==o.PicCount?print_Msg("Couldn't count remaining pictures."):(setupProgressBar("submit-form",o.PicCount),print_Msg("Pictures to process: "+o.PicCount,"plain"));for(var r=1;1>=r;){var c=importPicture(r,t);console.log(c),r++}}var startImageID=1;startImageID=document.getElementById("start-from-picture-id").value,document.getElementById("submit-form").addEventListener("click",importHandler);