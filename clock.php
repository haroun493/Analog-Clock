<!DOCTYPE html>
<html>
<body>
<div style="z-index: 100;position: absolute;margin-top:22%; text-shadow: 2px 2px black;margin-left: 12%;font-size: 30px;font-weight: bold;color: red;"><?php echo date('D M Y'); ?></div>
<canvas id="span" width="500px" height="500px" style="background: #1b4b72;">

</canvas>

<script>
var span = document.getElementById("span");
var shams = span.getContext("2d");
var radius = span.height / 2;
shams.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
  drawFace(shams, radius);
  drawNumbers(shams, radius);
  drawTime(shams, radius);
}

function drawFace(shams, radius) {
  var grad;
  shams.beginPath();
  shams.arc(0, 0, radius, 0, 2*Math.PI);
  shams.fillStyle = 'white';
  shams.fill();
  grad = shams.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
  grad.addColorStop(0, 'black');
  grad.addColorStop(0.5, 'black');
  grad.addColorStop(1, '#333');
  shams.strokeStyle = grad;
  shams.lineWidth = radius*0.1;
  shams.stroke();
  shams.beginPath();
  shams.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  shams.fillStyle = '#e33';
  shams.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius*0.15 + "px arial";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}
</script>

</body>
</html>
