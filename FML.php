<?php 
	
	/* 
		FML v0.8 (c) 2017 by Thielicious
		thielicious.github.io
		
		
		FML (Forum Markup Language) not the abbreviation you might think of :) 
		This script is easy to use and can be applied to any existing forum API. 
		It is a mix of BBCode and Markdown. 
		
		FML is still under construction, stay tuned.
	*/
	
	function fml($str) {
		if (preg_match_all("/([a-z]|[0-9])+\[|\]/", $str, $matches)) {
			$get = function($t) use ($str) {
				if (preg_match_all("/$t\[(.*?)\]/", $str, $matches)) {
					return count($matches) >= 1 ?
						$matches[0] : $matches;
				} 
			};
			$no_tags = function($str) {
				return preg_replace("/([a-z]|[0-9])+\[|\]/", "", $str);
			};
			$replace = [];

			// link
			if ($get("a")) { 
				foreach ($get("a") as $m) {
					if (preg_match("/http:\/\//",$m)) {
						$replace[$m] = "<a href='".$m."' target='_blank'>".$m."</a>";
					} else {
						$replace[$m] = $m;
					}
				}
			}

			// img
			if ($get("img")) { 
				foreach ($get("img") as $m) {
					$replace[$m] = 
						"<a style='display: inline;' href='".$m."' target='_blank'>
							<img style='background: #000; border: 1px solid #000;' width='50%' src='".$m."'>
						</a>";
				}
			}

			// bold
			if ($get("b")) { 
				foreach ($get("b") as $m) { 
					$replace[$m] = "<strong>".$m."</strong>";
				}
			}

			// underline
			if ($get("u")) { 
				foreach ($get("u") as $m) { 
					$replace[$m] = "<u>".$m."</u>";
				}
			}

			// italic
			if ($get("i")) { 
				foreach ($get("i") as $m) {
					$replace[$m] = "<em>".$m."</em>";
				}
			}

			// headline
			if ($get("h.")) {
				$hl = function($h, $match) {
					return "<h".$h." class=fml-h".$h.">".$match."</h".$h.">";
				};
				if ($get(".1")) foreach ($get(".1") as $m) { $replace[$m] = $hl("1",$m); }
				if ($get(".2")) foreach ($get(".2") as $m) { $replace[$m] = $hl("2",$m); }
				if ($get(".3")) foreach ($get(".3") as $m) { $replace[$m] = $hl("3",$m); }
				if ($get(".4")) foreach ($get(".4") as $m) { $replace[$m] = $hl("4",$m); }
				if ($get(".5")) foreach ($get(".5") as $m) { $replace[$m] = $hl("5",$m); }
				if ($get(".6")) foreach ($get(".6") as $m) { $replace[$m] = $hl("6",$m); }
			}

			// video
			if ($get("yt")) { 
				foreach ($get("yt") as $m) {
					$replace[$m] = "<iframe class=fml-yt width='420' height='315' frameborder='0' src='https://www.youtube.com/embed/".$m."'></iframe>";
				}
			}

			// font color
			if ($get("c+[0-9]{1,2}")) { 
				$dye = function($color, $match) {
					return "<span class=fml-c style='color: ".$color."'>".$match."</span>";
				};
				if ($get("c0")) foreach ($get("c0") as $m) { $replace[$m] = $dye("black",$m); }
				if ($get("c1")) foreach ($get("c1") as $m) { $replace[$m] = $dye("white",$m); }
				if ($get("c2")) foreach ($get("c2") as $m) { $replace[$m] = $dye("red",$m); }
				if ($get("c3")) foreach ($get("c3") as $m) { $replace[$m] = $dye("lightblue",$m); }
				if ($get("c4")) foreach ($get("c4") as $m) { $replace[$m] = $dye("yellow",$m); }
				if ($get("c5")) foreach ($get("c5") as $m) { $replace[$m] = $dye("violet",$m); }
				if ($get("c6")) foreach ($get("c6") as $m) { $replace[$m] = $dye("lightgreen",$m); }
				if ($get("c7")) foreach ($get("c7") as $m) { $replace[$m] = $dye("orange",$m); }
				if ($get("c8")) foreach ($get("c8") as $m) { $replace[$m] = $dye("turquoise",$m); }
				if ($get("c9")) foreach ($get("c9") as $m) { $replace[$m] = $dye("grey",$m); }
				if ($get("c10")) foreach ($get("c10") as $m) { $replace[$m] = $dye("green",$m); }
				if ($get("c11")) foreach ($get("c11") as $m) { $replace[$m] = $dye("pink",$m); }
				if ($get("c12")) foreach ($get("c12") as $m) { $replace[$m] = $dye("khaki",$m); }
				if ($get("c13")) foreach ($get("c13") as $m) { $replace[$m] = $dye("crimson",$m); }
				if ($get("c14")) foreach ($get("c14") as $m) { $replace[$m] = $dye("brown",$m); }
				if ($get("c15")) foreach ($get("c15") as $m) { $replace[$m] = $dye("darkblue",$m); }
			}

			// horizontal rule
			if ($get("hr")) { 
				foreach ($get("hr") as $m) {
					$replace[$m] = $m."<hr class=fml-hr>";
				}
			}

			// quotation
			if ($get("q")) { 
				foreach ($get("g") as $m) {
					$replace[$m] = "<quote class=fml-q>".$m."</quote>";
				}
			}

			return nl2br($no_tags(str_replace(array_keys($replace), array_values($replace), htmlentities($str))));
		} else {
			return nl2br(htmlentities($str));
		}
	}
?>