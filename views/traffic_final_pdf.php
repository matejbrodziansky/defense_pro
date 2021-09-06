<body>
	<div>
		<div style="text-align: center;" class="container   ">
			<div class="site-width">

				<p class=" text-center "><?= $pageHeaderTitle ?></p>
				<p style="text-align: left;">Porušenia <span style="border-bottom: 1px solid gray;"> zákazu zastavenia a státia</span> v zmysle § 25 zákona č. 8/2009 Z.z. o cestnej premávke
					a o zmene a doplnení niektorých zákonov v znení neskorších predpisov, konkr. písm.</p>
				<div>
					<?php
					if (isset($traffic_disruption['paragraphs']) && !empty($traffic_disruption['paragraphs'])) {
						foreach ($traffic_disruption['paragraphs'] as $paragraph) {
					?>
							<p style="text-align:left; padding-left:30px; margin: 5px 5px 0 50px;"><?= $paragraph ?></p>
					<?php
						}
					}
					?>
				</div>
				<table style="margin-top: 20px;" class="traffic-pdf ">
					<tr>
						<td>ŠPZ vozidla:</td>
						<td><i><span><?= $traffic_disruption['vrn'] ?></span></i></td>
					</tr>
					<tr>
						<td>Porušenia ste sa dopustili v katastri:</td>
						<td><i><span><?= $traffic_disruption['city'] ?></span></i></td>
					</tr>
					<tr>
						<td>Dňa:</td>
						<td><i><span><?= date("d.m.Y", strtotime($traffic_disruption['date'])) ?></span></i></td>
					</tr>
					<tr>
						<td>V čase: </td>
						<td><i><span><?= date("H:i:s", strtotime($traffic_disruption['date'])) ?></span></i></td>
					</tr>
					<tr>
						<td style="padding-right:30px;" class="SlateGridDataError">GPS súradnice vozidla v čase spáchania skutku: </td>
						<td><i><span><?= $traffic_disruption['latitude'] . ', ' .  $traffic_disruption['longitude'] ?></span></i></td>
					</tr>
				</table>
				<div style="text-align: left;">
					<p>Dokumentujúca osoba: Zisťovanie podkladov k skutku vykonala spol. Defense Pro, s.r.o.</p>
				</div>
				<div style="text-align: left;">
					<p class="text-center lh-10">Priestupok bol zaznamenaný technickými prostriedkami, ktoré využíva obec.</p>
					<p class="text-center lh-10">Priestupok bude riešený z rozhodnutia príslušnej obce vyvodením objektívnej zodpovednosti.</p>
					<p style="margin-bottom: 0px;">Podľa § 139a ods. 7 zákona č. 8/2009 Z.z. o cestnej premávke a o zmene a doplnení niektorých
						zákonov v znení neskorších predpisov</p>
					<p style="margin-top: 0px;">(7) Držiteľovi vozidla, ktorý porušil povinnosť podľa §6a písm.e), orgán Policajného zboru alebo
						obec uloží pokutu</p>
				</div>
				<table>
					<tr>
						<td style="padding-right:30px; padding-bottom:20px;"> a)</td>
						<td> 198 eur, ak bola porušená povinnosť podľa § 25 ods. 1 písm. g) alebo bol
							porušený zákaz zastavenia a státia na vyhradenom parkovacom mieste pre osobu
							so zdravotným postihnutím,</td>
					</tr>
					<tr>
						<td> b)</td>
						<td> 78 eur, ak bola porušená iná povinnosť podľa § 6a písm. e), ako je uvedené
							v písmene a)</td>
					</tr>
				</table>
			</div>
		</div>
	</div>