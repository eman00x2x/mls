<?php

namespace Main\Model;

class AddressModel extends \Main\Model {
	
	function addresses() {
	
		return array(
			/* METRO MANILA */
			"Antipolo City" => array("Bagong Nayon","Beverly Hills","Calawis","Cupang","Dalig","Dela Paz","Inarawan","Mambugan","Mayamot","Muntindilaw","San Isidro","San Jose","San Juan","San Luis","San Roque","Sta. Cruz"),
			"Caloocan City" => array("Amparo","Baesa","Bagong Barrio","Bagong Silang","Bagumbong","Barrio San Jose","BF Homes Caloocan","Biglang-Awa","Caloocan","Camarin","Camarin-Central","Camarin-Cielito","Camarin-Kiko","Congress Village","Dagat-Dagatan","Deparo","Deparo II","Grace Park East","Grace Park West","Heroes del 96","Kaunlaran Village","Libis Baesa","Libis Reparo","Llano","Malaria","Marulas","Maypajo","Monumento","Morning Breeze","Pangarap Village","Sangandaan","Santa Quiteria","Tala","Talipapa","University Hills","Urduja (Village)"),
			"Manila City" => array("Balic-Balic","Balut","Binondo","Ermita","Gagalangin","Intramuros","Malate","Paco","Pandacan","Port Area","Quiapo","Sampaloc","San Andres","San Miguel","San Nicolas","Santa Ana","Santa Cruz","Santa Mesa","Tondo","Tutuban","Vitas"),
			"Las Piñas City" => array("Almanza Uno","Almanza Dos","CAA-BF International","Daniel Fajardo","Elias Aldana","Ilaya","Manuyo Uno","Manuyo Dos","Pamplona Uno","Pamplona Dos","Pamplona Tres","Pilar Village","Pulang Lupa Uno","Pulang Lupa Dos","Talon Uno","Talon Dos","Talon Tres","Talon Cuatro","Talon Cinco"),
			"Makati City" => array("Bangkal","Bel-Air","Carmona","Cembo","Comembo","Dasmariñas","East Rembo","Forbes Park","Guadalupe Nuevo","Guadalupe Viejo","Kasilawan","La Paz","Magallanes","Poblacion","Olympia","Palanan","Pembo","Pinagkaisahan","Pio del Pilar","Pitogo","Post Proper Northside","Post Proper Southside","Rembo","Rizal","San Antonio","San Isidro","San Lorenzo","Santa Cruz","Singkamas","South Cembo","Tejeros","Urdaneta","Valenzuela","West Rembo"),
			"Malabon City" => array("Acacia","Baritan","Bayan-bayanan","Catmon","Concepcion","Dampalit","Flores","Hulong Duhat","Ibaba","Longos","Maysilo","Muzon","Niugan","Panghulo","Potrero","San Agustin","Santolan","Tañong","Tinajeros","Tonsuya","Tugatog"),
			"Mandaluyong City" => array("Addition Hills","Bagong Silang","Barangka Drive","Barangka Ibaba","Barangka Ilaya","Barangka Itaas","Buayang Bato","Burol","Daang Bakal","Hagdan Bato Itaas","Hagdan Bato Libis","Harapin ang Bukas","Highway Hills","Hulo","Mabini-J. Rizal","Malamig","Mauway","Namayan","New Zañiga","Old Zañiga","Pag-asa","Plainview","Pleasant Hills","San Jose","Vergara","Wack-Wack Greenhills"),
			"Marikina City" => array("Barangka","Calumpang","Concepcion","Fortune","Industrial Valley","Jesus de la Peña","Malanday","Marikina Heights","Nangka","Parang","San Roque","Santa Elena","Santo Niño","Tañong","Tumana"),
			"Muntinlupa City" => array("Alabang","Ayala Alabang","Bayanan","Buli","Cupang","Putatan","Sucat","Tunasan"),
			"Navotas City" => array("Bagumbayan North","Bagumbayan South","Bangkulasi","Daanghari","Navotas East","Navotas West","Northbay Boulevard North","Northbay Boulevard South","Northbay Boulevard South 1","Northbay Boulevard South 2","Northbay Boulevard South 3","San Jose","San Rafael Village","San Roque","Sipac-Almacen","Tangos North","Tangos South","Tanza"),
			"Parañaque City" => array("Baclaran","BF Homes","Don Bosco","Don Galo","La Huerta","Marcelo Green","Merville","Moonwalk","San Antonio","San Dionisio","San Isidro","San Martin de Porres","Santo Niño","Sun Valley","Tambo","Vitalez"),
			"Pasay City" => array("Batao","Bay City","Cabrera","Cartimar","Cuyegkeng","Don Carlos Village","Edang","Francis Burton Harrison","Kalayaan","Layug","Leveriza","Libertad","M. Dela Cruz","Malibay","Manila Bay Reclamation","Maricaban","Newport City","Nichols","Padre Burgos","Pasay Luna","Pasay Rotonda","PICC","Pildera Uno","Pildera Dos","Rivera Village","San Isidro","San Jose","San Pablo","San Rafael","San Roque","Santa Clara","Santo Niño","Tramo","Tripa De Gallina","Ventanilla","Villamor Airbase"),
			"Pasig City" => array("Bagong Ilog","Bagong Katipunan","Bambang","Buting","Caniogan","Dela Paz","Kalawaan","Kapasigan","Kapitolyo","Malinao","Manggahan","Maybunga","Oranbo","Palatiw","Pinagbuhatan","Pineda","Rosario","Sagad","San Antonio","San Joaquin","San Jose","San Miguel","San Nicolas","Santa Cruz","Santa Lucia","Santa Rosa","Santo Tomas","Santolan","Sumilang","Ugong"),
			"Pateros" => array("Aguho","Magtanggol","Martires","Pateros","San Pedro","San Roque","Santa Ana","Santo Rosario Kanluran","Santo Rosario Silangan","Tabacalera"),
			"Quezon City" => array("Alicia","Amihan","Apolonio Samson","Baesa","Bagbag","Bagong Lipunan ng Crame","Bagong Pag-asa","Bagong Silangan","Bagumbayan","Bagumbuhay","Bahay Toro","Balingasa","Balintawak","Balonbato","Batasan Hills","Bayanihan","Blue Ridge","Botocan","Bungad","Camp Aguinaldo","Capri","Central","Commonwealth","Culiat","Damar","Damayang Lagi","Del Monte","Dioquino Zobel","Don Manuel","Doña Aurora","Doña Imelda","Doña Josefa","Duyan Duyan","East Kamias","Escopa (I-IV)","E. Rodriguez","Fairview","Greater Lagro","Gulod","Horseshoe","Holy Spirit","Immaculate Concepcion","Kaligayahan","Kalusugan","Kamuning","Katipunan","Kaunlaran","Kristong Hari","Krus na Ligas","Laging Handa","Libis","Lourdes","Loyola Heights","Maharlika","Malaya","Mangga","Manresa","Mariana","Mariblo","Marilag","Masagana","Masambong","Matandang Balara","Milagrosa","Muñoz","Nagkaisang Nayon","Nayong Kanluran","New Era","North Fairview","Novaliches","N.S. Amoranto","Obrero","Old Capitol Site","Paang Bundok","Pag-ibig sa Nayon","Paligsahan","Paltok","Pansol","Paraiso","Pasong Putik","Pasong Tamo","Payatas","Phil-Am","Pinagkaisahan","Pinyahan","Project 6","Quirino 2","Quirino 3","Roxas","Sacred Heart","Salvacion","San Agustin","San Antonio","San Bartolome","San Isidro Galas","San Isidro Labrador","San Jose","San Martin de Porres","San Roque","San Vicente","Sangandaan","Santa Cruz","Santa Lucia","Santa Monica","Santa Teresita","Santo Cristo","Santo Domingo","Santo Niño","Santol","Sauyo","Siena","Sikatuna Village","Silangan","Socorro","St. Ignatius","St. Peter","Tagumpay","Talayan","Talipapa","Tandang Sora","Tatalon","Teacher's Village","Ugong Norte","Unang Sigaw","UP Campus","UP Village","Valencia","Vasra","Veterans Village","Villa Maria Clara","West Kamias","West Triangle","White Plains"),
			"San Juan City" => array("Addition Hills","Balong-bato","Batis","Corazon de Jesus","Ermitaño","Greenhills","Isabelita","Kabayanan","Little Baguio","Maytunas","Onse","Pasadena","Pedro Cruz","Progreso","Rivera","Salapan","San Perfecto","Santa Lucia","St. Joseph","Tibagan","West Crame"),
			"Taguig City" => array("Bagumbayan","Bambang","Calzada","Central Bicutan","Central Signal Village","Fort Bonifacio","Hagonoy","Ibayo Tipas","Katuparan","Ligid Tipas","Lower Bicutan","Maharlika Village","Napindan","New Lower Bicutan","North Daang Hari","North Signal Village","Palingon","Pinagsama","San Miguel","Santa Ana","South Daang Hari","South Signal Village","Tanyag","Tuktukan","Upper Bicutan","Ususan","Wawa","Western Bicutan"),
			"Valenuzuela" => array("Arkong Bato","Bagbaguin","Balangkas","Bignay","Bisig","Canumay","Coloong","Dalandanan","General T. de Leon","Isla","Karuhatan","Lawang Bato","Lingunan","Mabolo","Malanday","Malinta","Mapulang Lupa","Marulas","Maysan","Palasan","Parada","Pariancillo Villa","Paso de Blas","Pasolo","Polo","Punturin","Rincon","Tagalag","Ugong","Valenzuela","Veinte Reales"),
			
			/* PROVINCIAL AREA */
			"Rizal" => array("Angono","Baras","Binangonan","Cainta","Cardona","Jalajala","Morong","Pililla","Rodriguez","San Mateo","Tanay","Taytay","Teresa"),
			"Cavite" => array("Alfonso","Amadeo","Bacoor","Carmona","Cavite City","Dasmariñas","General Emilio Aguinaldo","General Mariano Alvarez","General Trias","Imus","Indang","Kawit","Magallanes","Maragondon","Mendez","Naic","Noveleta","Rosario","Silang","Tagaytay","Tanza","Ternate","Trece Martires"),
			"Tagaytay" => null,
			"Laguna" => array("Alaminos","Bay","Biñan","Cabuyao","Calamba","Calauan","Cavinti","Famy","Kalayaan","Liliw","Los Baños","Luisiana","Lumban","Mabitac","Magdalena","Majayjay","Nagcarlan","Paete","Pagsanjan","Pakil","Pangil","Pila","Rizal","San Pablo","San Pedro","Santa Cruz","Santa Maria","Santa Rosa","Siniloan","Victoria"),
			"Bulacan" => array("Angat","Balagtas","Baliuag","Bocaue","Bulakan","Bustos","Calumpit","Doña Remedios Trinidad","Guiguinto","Hagonoy","Malolos","Marilao","Meycauayan","Norzagaray","Obando","Pandi","Paombong","Plaridel","Pulilan","San Ildefonso","San Jose del Monte","San Miguel","San Rafael","Santa Maria"),
			"Batangas" => array("Agoncillo","Alitagtag","Balayan","Balete","Batangas City","Bauan","Calaca","Calatagan","Cuenca","Ibaan","Laurel","Lemery","Lian","Lipa","Lobo","Mabini","Malvar","Mataasnakahoy","Nasugbu","Padre Garcia","Rosario","San Jose","San Juan","San Luis","San Nicolas","San Pascual","Santa Teresita","Santo Tomas","Taal","Talisay","Tanauan","Taysan","Tingloy","Tuy"),
			"Zambales" => null,
			"Cebu" => null,
			"Davao" => null,
			"Pampanga" => null,
			"Bicol" => null
		);
		
	}
	
	function addressSelection($current_value = null) {

		if($current_value != null) {
			$current_value = json_encode($current_value);
		}else { $current_value = '{"region":"","province":"","municipality":"","barangay":""}'; }

		$doc = \Library\Factory::getDocument();
		$doc->addScript(CDN."philippines-addresses/json/table_address.js");
		$doc->addScriptDeclaration("

			let current_value = $current_value;
			
			$(document).ready(function() {
				html = \"<option value=''></option>\";
				for(let i = 0; i < region.length; i++) {
					let obj = region[i];
					name = obj.region_name;
					html += \"<option value='\" + obj.region_id + \"'>\" + name.replace('ñ', 'n') + \"</option>\";
				}
				$('#region').html(html);

				if(current_value.region != '') {
					$('#region option:contains(\"' + current_value.region + '\")').prop('selected', true);
					$('#region').trigger('change');

					if(current_value.province != '') {
						$('#province option:contains(\"' + current_value.province + '\")').prop('selected', true);
						$('#province').trigger('change');

						if(current_value.municipality != '') {
							$('#municipality option:contains(\"' + current_value.municipality + '\")').prop('selected', true);
							$('#municipality').trigger('change');

							if(current_value.barangay != '') {
								$('#barangay option:contains(\"' + current_value.barangay + '\")').prop('selected', true);
								$('#barangay').trigger('change');
							}
						}
					}
				}

			});

			$(document).on('change','#region',function() {
				region_id = $(this).val();
				$('input[name=\"address[region]\"]').val($('#region option:selected').text());

				html = \"<option value=''></option>\";
				for(let i = 0; i < province.length; i++) {
					let obj = province[i];
					if(obj.region_id == region_id) {
						name = obj.province_name;
						html += \"<option value='\" + obj.province_id + \"'>\" + name.replace('ñ', 'n') + \"</option>\";
					}
				}
				$('#province').html(html);

				$('#municipality').html('');
				$('#barangay').html('');

			});

			$(document).on('change','#province',function() {
				province_id = $(this).val();
				$('input[name=\"address[province]\"]').val($('#province option:selected').text());

				html = \"<option value=''></option>\";
				for(let i = 0; i < municipality.length; i++) {
					let obj = municipality[i];
					if(obj.province_id == province_id) {
						name = obj.municipality_name;
						html += \"<option value='\" + obj.municipality_id + \"'>\" + name.replace('ñ', 'n') + \"</option>\";
					}
				}
				$('#municipality').html(html);

				$('#barangay').html('');

			});

			$(document).on('change','#municipality',function() {
				municipality_id = $(this).val();
				$('input[name=\"address[municipality]\"]').val($('#municipality option:selected').text());

				html = \"<option value=''></option>\";
				for(let i = 0; i < barangay.length; i++) {
					let obj = barangay[i];
					if(obj.municipality_id == municipality_id) {
						name = obj.barangay_name;
						html += \"<option value='\" + obj.barangay_id + \"'>\" + name.replace('ñ', 'n') + \"</option>\";
					}
				}
				$('#barangay').html(html);

			});

			$(document).on('change','#barangay',function() {
				$('input[name=\"address[barangay]\"]').val($('#barangay option:selected').text());
			});

		");

		$html[] = "<div class='address p-3 bg-muted-lt border mb-3 rounded'>";

			$html[] = "<input type='hidden' name='address[barangay]' value='' />";
			$html[] = "<input type='hidden' name='address[municipality]' value='' />";
			$html[] = "<input type='hidden' name='address[province]' value='' />";
			$html[] = "<input type='hidden' name='address[region]' value='' />";

			$html[] = "<div class='mb-3'>";
				$html[] = "<label class='form-label text-muted'>Region</label>";
				$html[] = "<select id='region' class='form-select'>";
					$html[] = "<option value=''></option>";
				$html[] = "</select>";
			$html[] = "</div>";

			$html[] = "<div class='mb-3'>";
				$html[] = "<label class='form-label text-muted'>Province</label>";
				$html[] = "<select id='province' class='form-select'>";
					$html[] = "<option value=''></option>";
				$html[] = "</select>";
			$html[] = "</div>";

			$html[] = "<div class='mb-3'>";
				$html[] = "<label class='form-label text-muted'>Municipality</label>";
				$html[] = "<select id='municipality' class='form-select'>";
					$html[] = "<option value=''></option>";
				$html[] = "</select>";
			$html[] = "</div>";

			$html[] = "<div class='mb-3'>";
				$html[] = "<label class='form-label text-muted'>Barangay</label>";
				$html[] = "<select id='barangay' class='form-select'>";
					$html[] = "<option value=''></option>";
				$html[] = "</select>";
			$html[] = "</div>";

		$html[] = "</div>";

		return implode("",$html);
	}
	
}