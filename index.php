<?php
  require_once("includes/head.php");
  if (!$_SESSION[id]) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $site; ?> - Home</title>
  <link rel="stylesheet" href="css/global.css" media="screen" charset="utf-8">
</head>
<?php require_once("includes/log_nav.php"); ?>
</nav>
<body>
  <div class="main">
    <div class="container">
      <h1>Camagru</h1>
      <hr>
      <h2>Take your picture</h2>
      <br>
      <div class="camera">
        <div id="camera"></div>
          <canvas id='canvas'></canvas>
        </div>
      </div>
  </div>
  <div class="sidebar">
    <div class="container">
      <h2>Last Pics</h2>
    </div>
  </div>
<script type="text/javascript">
var moi='',data,canvas=document.getElementById('canvas'),pos=0,ctx=null,
    image=[],b=1,n=document.getElementById('stream');
var options={ // --- 1 ---
    width:700,
    height:500,
    swffile:"webcam.swf",
    wrapper:"webcam",
    jpgQuality:100,
    jpgEncode:1, // 0 : encodage JS ; 1 : encodage SWF
    refresh:2 // raffraichissement en ms
};
//
function webcam(){
        // --- 3 ---
    var source='<object id="camObj" type="application/x-shockwave-flash" data="'+options.swffile+'" width="'+options.width+'" height="'+options.height+'"><param name="movie" value="'+options.swffile+'" /><param name="FlashVars" value="width='+options.width+'&height='+options.height+'&jpgEncode='+options.jpgEncode+'&jpgQuality='+options.jpgQuality+'&refresh='+Math.floor(options.refresh*.9)+'&wrapper='+options.wrapper+'" /><param name="allowScriptAccess" value="always" /></object>';
    document.getElementById('camera').innerHTML=source;
    if (canvas.toDataURL){ // --- 2 ---
        ctx=canvas.getContext("2d");
        image=ctx.getImageData(0,0,options.width,options.height);
    }
    else if (jpgEncode!=1) alert("Votre navigateur est vraiment trop vieux. Essayez Firefox.");
    var run = 3;
    (_register=function() {
        var cam=document.getElementById('camObj');
        if(cam&&cam.capture!==undefined){
            webcam.capture=function(x){return cam.capture(x);}
            webcam.turnOff=function(){return cam.turnOff();}
            webcam.onSave=saveData;
            webcam.camOk=function(){/*la camera est prête*/}
        }
        else if(run==0)return;
        else{run--;window.setTimeout(_register, 1000*(4-run));}
    })();
}
function saveData(data){
    if(options.jpgEncode==0) {
        var col=data.split(";");
        var img=image;
        for (i=0;i<options.width;i++){tmp=parseInt(col[i]);img.data[pos+0]=(tmp>>16)&0xff;img.data[pos+1]=(tmp>>8)&0xff;img.data[pos+2]=tmp&0xff;img.data[pos+3]=0xff;pos+=4;}
        if (pos>=4*options.width*options.height){
            ctx.putImageData(img,0,0);
            // --- 4 ---
            if(b==1) upload("id="+moi+"&image="+canvas.toDataURL("image/jpeg",(options.jpgQuality)/100));
            pos=0;
        }
    } else if(b==1) upload("id="+moi+"&image="+data);
}
function upload(s){
    b=0;
    a=new XMLHttpRequest();
    a.open("POST","upload.php",true);
    a.setRequestHeader('Content-Type', "application/x-www-form-urlencoded; charset=UTF-8");
    a.setRequestHeader("Content-length", s.length);
    a.onreadystatechange=function(){if(a.readyState==4)b=1;}
    a.send(s);
}
function stream_cam(){n.src='webcam/web'+document.getElementById('toi').value+'.jpg?'+new Date().getTime();}
function stream_on(){vue=setInterval('stream_cam();',options.refresh);}
// --- 5 ---
window.onload=function(){webcam();};
</script>
</body>
</html>
