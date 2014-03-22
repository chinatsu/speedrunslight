<!DOCTYPE html>
<html>
	<head>
		<title>SpeedRunsLight</title>
		<meta name="description" content="Speedrunning live-streams.">
		<meta name="keywords" content="stream, live">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="icon" type="image/png" href="favico.png">
		<link rel="stylesheet" href="lol.css">
	</head>
	<body>
		<div id="streamList">
			<?php
			$game = null;
			$file = null;
			$cache = "api.txt";
			function game_blacklist($game)
			{
				$gameBlacklist = array("Age of Empires","Audiosurf","beatmania","Dance Dance Revolution","DayZ",
					"Diablo","Dota 2","Guild Wars","Guitar Hero","Heroes of Newerth","iDOLM@STER","Idolmaster","League of Legends",
					"Mario Party","Minecraft","Osu!","Ragnarok Online","Rock Band","RuneScape","Starcraft","StepMania","Super Smash Bros",
					"Team Fortress","Terraria","Total Annihilation","Warcraft","Worms");
				if ($game == "") {return true;}
				foreach ($gameBlacklist as $game_a){
					if (strpos($game, $game_a) !== false)
						return true;
				}
				return false;
			}
			if (file_exists($cache) && (filemtime($cache) > (time() - 60 ))) {
			   $file = file_get_contents($cache);
			} else {
			   $file = file_get_contents("http://api.speedrunslive.com/test/team");
			   file_put_contents($cache, $file);
			}
			$json = json_decode($file, true);
			foreach ($json["channels"] as $channel)
			{
				$game = $channel["channel"]["meta_game"];
				if (game_blacklist($game) == true){}
				else{
					echo '<a href="http://twitch.tv/',strtolower($channel["channel"]["display_name"]),'"><div class="streamerinfo">
					<span class="name">',$channel["channel"]["display_name"], '</span><br/>
					<span class="game">',$game, '</span>
					<div class="viewers">', $channel["channel"]["current_viewers"], ' viewers</div>
					<div class="descrip">', $channel["channel"]["title"], '</div>
					</div></a>';
				}
			}
			?>
		</div>
		<div id="footer">
			made by <a href="../">china</a> • <a href="http://speedrun.tv/">SpeedrunTV</a> • <a href="http://speedrunslive.com/">SpeedRunsLive</a>
		</div>
	</body>
</html>
