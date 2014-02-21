<!DOCTYPE html>
<html>
	<head>
		<title>SpeedRunsLight - literally NoScript</title>
		<meta name="description" content="Speedrunning live-streams.">
		<meta name="keywords" content="stream, live">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="icon" type="image/png" href="favico.png">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="style.css">
		<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>
	<body>
		<div id="streamList">
			<?php
			$game = null;
			
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
			$json = json_decode(file_get_contents("http://api.speedrunslive.com/test/team"), true);
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
			made by <a href="../">china</a>  • <a href="http://speedrunslive.com/">SpeedRunsLive</a>
		</div>
	</body>
</html>
