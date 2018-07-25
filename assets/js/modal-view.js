var initialModalScale,modal=document.getElementById("modal-wrap"),modalContent=document.getElementById("modal-content"),modalBG=document.getElementById("modal-background"),anchorsArray=$("#content-single-page a:has(img)");function openPictureModal(e,t,a,n){modal.style.display="block",modalBG.style.display="block",modalBG.style.animationName="fadeIn";var o=n*e,r=document.documentElement.clientHeight;if(o<r)var l=a+(r-o)/2;else l=a;setTimeout(function(){modalContent.style.transform="scale(1) translate("+t+"px, "+l+"px)"},20),modalState="open"}function closePictureModal(e){modalContent.style.transform="scale("+e+") translate(0px, 0px)",modalBG.style.animationName="fadeOut",modalBG.style.animationFillMode="forwards",setTimeout(function(){modal.style.display="none",modalBG.style.display="none",modalContent.innerHTML=""},500),modalState="close"}function loadLargerImage(t){var e=initiateProgressBar(t),a=t.currentTarget.getAttribute("href"),n=new Image,o=setInterval(function(){e.style.transform="scaleX("+n.compvaredPercentage/100+")",console.log("loaded: "+n.compvaredPercentage),100==n.compvaredPercentage&&clearInterval(o)},100);n.load(a),n.onload=function(){var e=n.height;drawModalSingleImage(t,e)},n.className="zoom-picture",modalContent.appendChild(n)}function drawModalSingleImage(e,t){removeProgressBar();var a=e.currentTarget,n=$(a).width();$(a).height();console.log("anchorWidth: "+n+"px");var o=document.documentElement.clientWidth,r=$("#content-wrap").width();Math.max(document.documentElement.clientHeight,window.innerHeight||0);initialModalScale=n/r,console.log("initialModalScale: "+initialModalScale);var l=0;r<o&&(l=(o-r)/2);var d=e.currentTarget.getBoundingClientRect(),i=d.top,c=d.left-l;modalContent.style.top=i+"px",modalContent.style.left=c+"px",modalContent.style.transformOrigin="top left",modalContent.style.transform="scale("+initialModalScale+")",openPictureModal(r/n,-c,-i,e.target.height)}function initiateProgressBar(e){var t=document.createElement("div");t.id="progress-bar";var a=e.currentTarget.parentElement;return a.style.position="relative",a.appendChild(t),t}function removeProgressBar(){if(!document.getElementById("progress-bar"))return console.log("Progress bar wasn't found. So it couldn't be removed."),!1;document.getElementById("progress-bar").remove()}$(anchorsArray).click(function(e){e.preventDefault();var t=e.currentTarget.parentElement;$(t).hasClass("gallery-icon"),loadLargerImage(e)}),Image.prototype.load=function(e){var a=this,t=new XMLHttpRequest;t.open("GET",e,!0),t.responseType="arraybuffer",t.onload=function(e){var t=new Blob([this.response]);a.src=window.URL.createObjectURL(t)},t.onprogress=function(e){a.compvaredPercentage=parseInt(e.loaded/e.total*100)},t.onloadstart=function(){a.compvaredPercentage=0},t.send()},Image.prototype.compvaredPercentage=0,modal.addEventListener("click",function(){closePictureModal(initialModalScale)});