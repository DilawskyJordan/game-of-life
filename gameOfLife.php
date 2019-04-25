<?php 
class Game {

	public $worldX 		= 	NULL;
	public $worldY 		= 	NULL;
	public $cells 		= 	[];
	public $liveCells  	= 	NULL;

	public function buildWorld() {

		$this->worldX 	= 	100;
		$this->worldY 	= 	30;

		// dead cells
		for ($y=0; $y <= $this->worldY ; $y++) { 
			for ($x=0; $x <= $this->worldX ; $x++) { 
				$this->cells["$x,$y"] = "0,0";
			}
		}

		// live 

		$y = $this->worldY-5;
		$this->cells["80,$y"] = "1,1";
		$this->cells["81,$y"] = "1,1";
		$this->cells["82,$y"] = "1,1";
		$this->cells["83,$y"] = "1,1";
		$this->cells["84,$y"] = "1,1";
		$this->cells["85,$y"] = "1,1";
		$this->cells["86,$y"] = "1,1";
		$this->cells["87,$y"] = "1,1";
		$this->cells["88,$y"] = "1,1";
		$this->cells["89,$y"] = "1,1";

		$y 	= $this->worldY-15; 
		$this->cells["50,$y"] = "1,1";
		$this->cells["51,$y"] = "1,1";
		$this->cells["52,$y"] = "1,1";
		$this->cells["53,$y"] = "1,1";
		$this->cells["54,$y"] = "1,1";
		$this->cells["55,$y"] = "1,1";
		$this->cells["56,$y"] = "1,1";
		$this->cells["57,$y"] = "1,1";
		$this->cells["58,$y"] = "1,1";
		$this->cells["59,$y"] = "1,1";

		$y = $this->worldY-20;
		$this->cells["1,$y"] 	= 	"1,1";
		$y = $this->worldY-21;
		$this->cells["2,$y"]	= 	"1,1";
		$y = $this->worldY-22;
		$this->cells["0,$y"] 	= 	"1,1";
		$this->cells["1,$y"] 	= 	"1,1";
		$this->cells["2,$y"]	= 	"1,1";

		$y = $this->worldY-7;
		$this->cells["2,$y"] = "1,1";
		$this->cells["3,$y"] = "1,1";
		$this->cells["4,$y"] = "1,1";
		$this->cells["5,$y"] = "1,1";
		$y = $this->worldY-8;
		$this->cells["1,$y"] = "1,1";
		$this->cells["5,$y"] = "1,1";
		$y = $this->worldY-9;
		$this->cells["5,$y"] = "1,1";
		$y = $this->worldY-10;
		$this->cells["1,$y"] = "1,1";
		$this->cells["4,$y"] = "1,1";
		return true;
	}

	public function play($i) {
		$this->show($i);
		$this->check();
		$this->apply($i);
	}

	public function check() {
		$neighbors = 0;
		for ($y=$this->worldY; $y >= 0; $y--) { 
			for ($x=$this->worldX; $x >= 0 ; $x--) { 
				if (array_key_exists(($x-1).",$y", $this->cells)) {
					if ($this->cells[($x-1).",$y"] === "1,1" OR $this->cells[($x-1).",$y"] === "1,0") {
						$neighbors++;	
					}
				}				
				if (array_key_exists(($x+1).",$y", $this->cells)) {
					if ($this->cells[($x+1).",$y"] === "1,1" OR $this->cells[($x+1).",$y"] === "1,0") {
						$neighbors++;
					}
				}				
				if (array_key_exists("$x,".($y-1), $this->cells)) {
					if ($this->cells["$x,".($y-1)] === "1,1" OR $this->cells["$x,".($y-1)] === "1,0") {
						$neighbors++;
					}
				}				
				if (array_key_exists("$x,".($y+1), $this->cells)) {
					if ($this->cells["$x,".($y+1)] === "1,1" OR $this->cells["$x,".($y+1)] === "1,0") {
						$neighbors++;
					}
				}				
				if (array_key_exists(($x-1).",".($y+1), $this->cells)) {
					if ($this->cells[($x-1).",".($y+1)] === "1,1" OR $this->cells[($x-1).",".($y+1)] === "1,0") {
						$neighbors++;
					}
				}				
				if (array_key_exists(($x+1).",".($y+1), $this->cells)) {
					if ($this->cells[($x+1).",".($y+1)] === "1,1" OR $this->cells[($x+1).",".($y+1)] === "1,0") {
						$neighbors++;
					}
				}				
				if (array_key_exists(($x+1).",".($y-1), $this->cells)) {
					if ($this->cells[($x+1).",".($y-1)] === "1,1" OR $this->cells[($x+1).",".($y-1)] === "1,0") {
						$neighbors++;
					}
				}				
				if (array_key_exists(($x-1).",".($y-1), $this->cells)) {
					if ($this->cells[($x-1).",".($y-1)] === "1,1" OR $this->cells[($x-1).",".($y-1)] === "1,0") {
						$neighbors++;
					}
				}
				if ($this->cells["$x,$y"] === "1,1") {
					if ($neighbors <= 1 OR $neighbors >= 4) {
						$this->cells["$x,$y"] = "1,0";
					}
					if ($neighbors === 2 OR $neighbors === 3) {
						$this->cell["$x,$y"] = "1,1";
					}
				} 
				if ($this->cells["$x,$y"] === "0,0") {
					if ($neighbors === 3) {
						$this->cells["$x,$y"] = "0,1";
					}
				}
				$neighbors = 0;
			}
		}
	}

	public function apply($i) {
		foreach ($this->cells as $coordinates => $status) {
			if ($status === "0,1") {
				$this->cells[$coordinates] = "1,1";
			}
			if ($status === "1,0") {
				$this->cells[$coordinates] = "0,0";
			}
		}
	}

	public function show($i) {
		echo "Generation: $i\n";
		for ($y=$this->worldY; $y >= 0 ; $y--) { 
			for ($x=0; $x <= $this->worldX ; $x++) { 
				if ($this->cells["$x,$y"] === "1,1") {
					echo "▪";
				}
				if ($this->cells["$x,$y"] === "0,0") {
					echo " ";
				}
			}
			echo "\n";
		}
		echo str_repeat("-", $this->worldX);
	}


}

$game = new Game;
$game->buildWorld();
for ($i=0; $i <= 1000 ; $i++) { 
	$game->play($i);
	sleep(0.5);
	echo exec("tput clear");
}
