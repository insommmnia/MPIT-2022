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
        $text_query2 = "SELECT * FROM posts";                           
        $query = mysqli_query($connect, $text_query);
        $con = mysqli_query($connect, $text_query2);               
            $result = $query->fetch_assoc();
            };
            ?>
                                   
				<div style="display: flex; padding-top:20px;">
				<p></p>
				
				<a href="login/addevent.php"><button class="header-btn header-btn-log">Предложить дело</button></a>
				<a href="php/exit.php"><button class="header-btn header-btn-sig">Выход</button></a>
				</div>
			</div>
		</div>
	</header>
	<main>
		<section class="service">
			<div class="container">
				<h2 class="service-title">
					Предстоящие события
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
						
						<a href="#" class="link service-link">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							viewBox="0 0 494.148 494.148" style="enable-background:new 0 0 494.148 494.148;" xml:space="preserve">
								<g>
									<g>
										   <path d="M405.284,201.188L130.804,13.28C118.128,4.596,105.356,0,94.74,0C74.216,0,61.52,16.472,61.52,44.044v406.124
										   c0,27.54,12.68,43.98,33.156,43.98c10.632,0,23.2-4.6,35.904-13.308l274.608-187.904c17.66-12.104,27.44-28.392,27.44-45.884
										   C432.632,229.572,422.964,213.288,405.284,201.188z"/>
									</g>
								</g>
							</svg>
							<span>Откликнуться</span>
						</a>
					</li>
					<?php }; ?>
				
				</ul>
			</div>
		</section>
	</main>
</body>
<script>
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