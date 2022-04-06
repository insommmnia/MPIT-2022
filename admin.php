<?php 
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/main.css">
    <title>Главная</title>
</head>
<body>
     <canvas id="canvas" style="position: absolute;" ></canvas>
    <header class="header">
		<div class="container header-container">
			<a class="logo" style="max-width: 150px; margin-top: 10px;">
				<img src="img/logo.png" alt="Inso logo">
			</a>
			<div class="menu-dek" >
            <?php if ($_SESSION['id'] != "") {
                                  
            $connect = mysqli_connect("j47246945.myjino.ru","j47246945","nikitka20041616","j47246945");
        $text_query = "SELECT * FROM users WHERE id = '{$_SESSION['id']}'";
        $text_query2 = "SELECT * FROM suggestions";                           
        $query = mysqli_query($connect, $text_query);
        $con = mysqli_query($connect, $text_query2);               
            $result = $query->fetch_assoc();
            };
            ?>
                                   
				<div style="display: flex; padding-top:20px;">
				<p></p>
				
				<a href="login/addeventadmin.php"><button class="header-btn header-btn-log">Опубликовать дело</button></a>
				<a href="php/exit.php"><button class="header-btn header-btn-sig">Выход</button></a>
				</div>
			</div>
		</div>
	</header>
	<main>
		<section class="service">
			<div class="container">
				<h2 class="service-title">
					Предложенные дела
				</h2>
				<ul class="service-list list-reset">
                <?php 
	 		
	 		        for($i=0;$i<$con->num_rows;$i++){
	 		        $result2 = $con->fetch_assoc(); 
	 		        
	 	            ?>  
					  <li class="service-item">
						<h3 class="service-subtitle">
							<?php echo $result2["name"]; ?> 
						</h3>
						<div style="background:; height: 250px; max-width: 220px;"> 
						<img src=" 	<?php echo $result2["img"]; ?> " style='max-width: 220px; paddint-bottom: 20px;'/>
						</div>
						
						<p class="service-place">
						<?php echo $result2["descr"]; ?>
						</p>
						<p class="service-descr" >
						<?php echo $result2["place"]; ?>
						</p>
						<p class="service-descr" >
							<?php echo $result2["author"]; ?>
						</p>
						
					    <form method="POST" enctype="multipart/form-data" action="php/addeventmain.php" >
					        
					        <input  value="<?php echo $result2["name"]; ?>" name="name" type="hidden">
					        <input  value="<?php echo $result2["author"]; ?>" name="author" type="hidden">
					        <input  value="<?php echo $result2["descr"]; ?>" name="descr" type="hidden">
					        <input value="<?php echo $result2["place"]; ?>" name="place" type="hidden">
					        <input  value="<?php echo $result2["img"]; ?>" name="img"  type="hidden">
					        <button class="header-btn header-btn-log" type="submit">Опубликовать</button>
							
					        </form>

				        
                        
						
						
						
					</li>
					<?php }; ?>
				
				</ul>
			</div>
		</section>
	</main>
</body>
<script>
document.getElementById("Linka").onclick = function() {
    document.getElementById("Linka").submit();
}

let pageWidth = document.documentElement.scrollWidth;
	let pageHeight = document.documentElement.scrollHeight+300;
	 console.log(pageHeight); 
	let c = init("canvas"),
  w = (canvas.width = pageWidth),
  h = (canvas.height = pageHeight);
class firefly{
  constructor(){
    this.x = Math.random()*w;
    this.y = Math.random()*h;
    this.s = Math.random()*2;
    this.ang = Math.random()*2*Math.PI;
    this.v = this.s*this.s/4;
  }
  move(){
    this.x += this.v*Math.cos(this.ang);
    this.y += this.v*Math.sin(this.ang);
    this.ang += Math.random()*20*Math.PI/180-10*Math.PI/180;
  }
  show(){
    c.beginPath();
    c.arc(this.x,this.y,this.s,0,2*Math.PI);
    c.fillStyle="#78b88b";
    c.fill();
  }
}

let f = [];

function draw() {
  if(f.length < 40){
    for(let j = 0; j < 10; j++){
     f.push(new firefly());
  }
     }
  //animation
  for(let i = 0; i < f.length; i++){
    f[i].move();
    f[i].show();
    if(f[i].x < 0 || f[i].x > w || f[i].y < 0 || f[i].y > h){
       f.splice(i,1);
       }
  }
}

let mouse = {};
let last_mouse = {};

canvas.addEventListener(
  "mousemove",
  function(e) {
    last_mouse.x = mouse.x;
    last_mouse.y = mouse.y;

    mouse.x = e.pageX - this.offsetLeft;
    mouse.y = e.pageY - this.offsetTop;
  },
  false
);
function init(elemid) {
  let canvas = document.getElementById(elemid),
    c = canvas.getContext("2d"),
    w = (canvas.width = pageWidth),
    h = (canvas.height = pageHeight);
  c.fillStyle = "rgb(255, 0, 0)";
  c.fillRect(0, 0, w, h);
  return c;
}

window.requestAnimFrame = (function() {
  return (
    window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.oRequestAnimationFrame ||
    window.msRequestAnimationFrame ||
    function(callback) {
      window.setTimeout(callback);
    }
  );
});

function loop() {
  window.requestAnimFrame(loop);
  c.clearRect(0, 0, w, h);
  draw();
}

window.addEventListener("resize", function() {
  (w = canvas.width = pageWidth),
  (h = canvas.height = pageHeight+200);
  loop();
});

loop();
setInterval(loop, 1000 / 60);
</script>
</html>