<?php
/**
Plugin Name: Property Mailer Ribena
Description: Email available properties to the agencies
Version: 1.0
Author: Rokas Bendikas
Text Domain: pm-ribena-api
*/

//////////////////////////////////////////////////////////////////////////

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/////////////////////////////////////////////////////////////////////////////////////////


///Hook into that action that'll fire at set time
add_action( 'send_email_ribena', 'send_email_ribena' );


//Function sending an email to the agencies
function send_email_ribena() {

	$message = 
	"
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>Demystifying Email Design</title>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
	</head>
	<body bgcolor='F5F9FA'>
	<img class='wp-image-667 alignleft' title='logo' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2020/03/logo.png' alt=''>
	<p><br>
        <strong>Sveiki,</strong>
        <p>
        UAB RIBENA siūlo šiuos nekilnojamo turto objektus nuomai:
        <p>
	<strong><h3>„RIBENOS verslo centras“</h3></strong> 
        <p><br>";



	$date = array();
	$area = array();
	$show = array();
        $price = array();
        $date_for_show = array();

	for ($i = 1; $i <= 44; $i++) {

	    $date[] = get_date($i);
	    $area[]= get_area($i);
            $price[] = round(get_price($i) * get_area($i),0);
	    if(get_today() >= $date[$i-1]){
	       $show[$i-1] = 1;
               $date_for_show[$i-1] = "<span style='Color:#00ff00;'>Laisva</span>";

	    } elseif($date[$i-1] < date('Y-m-d', strtotime(' + 60 days'))){
               $show[$i-1] = 1;
               $ind = $i-1;
               $date_for_show[$i-1] = "<span style='Color:red;'>Laisva nuo $date[$ind]</span>";

            } else{
	       $show[$i-1] = 0;
               $date_for_show[$i-1] = "";
	    }
	} 

	if($show[0]==1){

	$message .= 
	"
	<strong>Sandėlio patalpos Nr.&nbsp;4- 24, 25, 26</strong>
	<p>
	<img class='wp-image-667 alignleft' title='Sandėlio patalpos Nr. 1-73/1' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2017/06/IMG_2663-300x225.jpg' alt='' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[0]
        <p>
	<strong>Plotas:</strong> $area[0] m²
	<p> 
        <strong>Kaina:</strong> $price[0] EUR + PVM
        <p>
	<a href='http://ribena.lt/wp-content/uploads/2017/06/Gelininkai.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)
	</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-3/'>Plačiau...</a>
	<hr>";
	}



	if($show[1]==1){
	$message .= 
	"
	<strong>Sandėlio patalpos Nr. 4- 11</strong>
	<p>
	<img class='wp-image-677 alignleft' title='Sandėlio patalpos Nr. 1-73/2' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2017/06/IMG_2673-300x225.jpg' alt='' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[1]
        <p>
	<strong>Plotas:</strong> $area[1] m²
	<p>
        <strong>Kaina:</strong> $price[1] EUR + PVM
        <p>
	<a href='http://ribena.lt/wp-content/uploads/2017/06/SLO-sandelys.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)
	</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribenos-verslo-centras-klaipeda/biuro-patalpos-nr-4-11/'>Plačiau...</a>

	<hr>";
	}


	if($show[2]==1){
	$message .= 
	"
	<strong>Prekybinės patalpos Nr.&nbsp;4- 21</strong>
	<p>
	<img class='wp-image-673 alignleft' title='Prekybinės patalpos Nr. 1-63' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2017/06/IMG_2669-300x225.jpg' alt='' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[2]
        <p>
	<strong>Plotas:</strong> $area[2] m²
	<p>
        <strong>Kaina:</strong> $price[2] EUR + PVM
        <p>
	<a href='http://ribena.lt/wp-content/uploads/2017/06/SLO-parduotuve.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/patalpos-nr-4-21'>Plačiau...</a>

	<hr>";
	}



	if($show[3]==1){
	$message .= 
	"
	<strong>Prekybinės patalpos Nr.&nbsp;4- 23</strong>
	<p>
	<img class='alignleft wp-image-1250' title='Sandėlio patalpos Nr. 1-73/1' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2019/06/IMG_9851-300x225.jpeg' alt='' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[3]
        <p>
	<strong>Plotas:</strong> $area[3] m²
	<p>
        <strong>Kaina:</strong> $price[3] EUR + PVM
        <p>
	<a href='http://ribena.lt/wp-content/uploads/2017/06/Trade-home-parduotuve.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)
	</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/patalpos-nr-4-23'>Plačiau...</a>

	<hr>";
	}



	if($show[4]==1){
	$message .= 
	"
	<strong>Prekybinės patalpos Nr.&nbsp;4-&nbsp;1</strong>
	<p>
	<img class='wp-image-696 alignleft' title='Sandėlio patalpos Nr. 1-73/1' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2017/06/IMG_2693-300x225.jpg' alt='' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[4]
        <p>
	<strong>Plotas:</strong> $area[4] m²
	<p>
        <strong>Kaina:</strong> $price[4] EUR + PVM
        <p>
	<a href='http://ribena.lt/wp-content/uploads/2017/06/flamanda.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)
	</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/patalpos-nr-4-1'>Plačiau...</a>

	<hr>";
	}


	if($show[5]==1){
	$message .= 
	"
	<strong>Biuro patalpos Nr. 23</strong>
	<p>
	<img class='alignleft wp-image-53 size-full' title='Biuro patalpos Nr. 23' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/rvc-4.jpg' alt='Biuro patalpos Nr. 23' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[5]
        <p>
	<strong>Plotas:</strong> $area[5] m²
	<p>
        <strong>Kaina:</strong> $price[5] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/silutes_pl51_2a_23.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-23'>Plačiau...</a>

	<hr>";
	}



	if($show[6]==1){
	$message .= 
	"
	<strong>Biuro patalpos Nr. 24</strong>
	<p>
	<img class='alignleft wp-image-53 size-full' title='Biuro patalpos Nr. 24' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/rvc-4.jpg' alt='Biuro patalpos Nr. 24' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[6]
        <p>
	<strong>Plotas:</strong> $area[6] m²
	<p>
        <strong>Kaina:</strong> $price[6] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/silutes_pl51_2a_24.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-24/'>Plačiau...</a>

	<hr>";
	}



	if($show[7]==1){
	$message .= 
	"
	<strong>Biuro patalpos Nr. 25</strong>
	<p>
	<img class='alignleft wp-image-61 size-full' title='Biuro patalpos Nr. 25' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/rvc-6.jpg' alt='Biuro patalpos Nr. 25' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[7]
        <p>
	<strong>Plotas:</strong> $area[7] m²
	<p>
        <strong>Kaina:</strong> $price[7] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/silutes_pl51_2a_25.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-25'>Plačiau...</a>

	<hr>";
	}




	if($show[8]==1){
	$message .= 
	"
	<strong>Biuro patalpos Nr. 26</strong>
	<p>
	<img class='alignleft wp-image-66 size-full' title='Biuro patalpos Nr. 26' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/rvc-7.jpg' alt='Biuro patalpos Nr. 26' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[8]
        <p>
	<strong>Plotas:</strong> $area[8] m²
	<p>
        <strong>Kaina:</strong> $price[8] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/silutes_pl51_2a_26.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-26'>Plačiau...</a>

	<hr>";
	}




	if($show[9]==1){
	$message .= 
	"
	<strong>Biuro patalpos Nr. 27</strong>
	<p>
	<img class='alignleft wp-image-53 size-full' title='Biuro patalpos Nr. 27' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/rvc-4.jpg' alt='Biuro patalpos Nr. 27' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[9]
        <p>
	<strong>Plotas:</strong> $area[9] m²
	<p>
        <strong>Kaina:</strong> $price[9] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/silutes_pl51_2a_27.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-27'>Plačiau...</a>

	<hr>";
	}

	if($show[10]==1){
	$message .= 
	"
	<strong>Prekybinės patalpos Nr. 1, 3, 4, 5</strong>
	<p>
	<img class='alignleft wp-image-72 size-full' title='Prekybinės patalpos Nr. 1' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/cnt-1.jpg' alt='Prekybinės patalpos Nr. 1' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[10]
        <p>
	<strong>Plotas:</strong> $area[10] m²
	<p>
        <strong>Kaina:</strong> $price[10] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/silutes_pl53_1a_1.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-10/'>Plačiau...</a>

	<hr>";
	}



	if($show[11]==1){
	$message .= 
	"
	<strong>Prekybinės patalpos Nr. 2, 3, 4, 5</strong>
	<p>
	<img class='alignleft wp-image-72 size-full' title='Prekybinės patalpos Nr. 2' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/cnt-1.jpg' alt='Prekybinės patalpos Nr. 2, 7' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[11]
        <p>
	<strong>Plotas:</strong> $area[11] m²
	<p>
        <strong>Kaina:</strong> $price[11] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2019/06/silutes_pl53_1a_2.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-2/'>Plačiau...</a>

	<hr>";
	}




	if($show[12]==1){
	$message .= 
	"
	<strong>Prekybinės patalpos Nr. 7</strong>
	<p>
	<img class='alignleft wp-image-72 size-full' title='Prekybinės patalpos Nr. 7' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/cnt-1.jpg' alt='Prekybinės patalpos Nr. 7' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[12]
        <p>
        <strong>Plotas:</strong> $area[12] m²
	<p>
        <strong>Kaina:</strong> $price[12] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2019/06/silutes_pl53_1a_7.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-7/'>Plačiau...</a>

	<hr>";
	}




	if($show[13]==1){
	$message .= 
	"
	<strong>Prekybinės - sandėliavimo patalpos Nr. 8, 9, 15</strong>
	<p>

	<img class='alignleft wp-image-77 size-full' title='Prekybinės patalpos Nr. 8, 9' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/cnt-2.jpg' alt='Prekybinės patalpos Nr. 8, 9' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[13]
        <p>
	<strong>Plotas:</strong> $area[13] m²
	<p>
        <strong>Kaina:</strong> $price[13] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/silutes_pl53_1a_8ir9.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-12'>Plačiau...</a>

	<hr>";
	}




	if($show[14]==1){
	$message .= 
	"
	<strong>Prekybinės - sandėliavimo patalpos Nr. 12, 13, 16</strong>
	<p>
	<img class='alignleft wp-image-72 size-full' title='Prekybinės patalpos Nr. 12, 16' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/cnt-1.jpg' alt='Prekybinės patalpos Nr. 12, 16' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[14]
        <p>
	<strong>Plotas:</strong> $area[14] m²
	<p>
        <strong>Kaina:</strong> $price[14] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/silutes_pl53_1a_12ir16.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-12-16/'>Plačiau...</a>

	<hr>";
	}




	if($show[15]==1){
	$message .= 
	"
	<strong>Sandėlio patalpos Nr. 17</strong>
	<p>

	<img class='alignleft wp-image-81 size-full' title='Sandėlio patalpos Nr. 17' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/cnt-3.jpg' alt='Sandėlio patalpos Nr. 17' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[15]
        <p>
	<strong>Plotas:</strong> $area[15] m²
	<p>
        <strong>Kaina:</strong> $price[15] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/silutes_pl53_1a_17.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-13'>Plačiau...</a>

	<hr>";
	}


	if($show[16]==1){
	$message .= 
	"
	<strong>Biuro patalpos Nr. 2- 8, 9, 10, 11, 12</strong>
	<p>
	<img class='alignleft wp-image-88 size-full' title='Biuro patalpos  Nr. 2- 8' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2018/05/IMG_4338.jpg' alt='Biuro patalpos  Nr. 2- 8' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[16]
        <p>
	<strong>Plotas:</strong> $area[16] m²
	<p>
        <strong>Kaina:</strong> $price[16] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2018/06/2-8.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras-klaipeda/patalpos-nr-2-8/'>Plačiau...</a>

	<hr>";
	}



	if($show[17]==1){
	$message .= 
	"
	<strong>Biuro patalpos&nbsp;Nr. 2- 2, 3, 4, 5, 6, 11, 12</strong>
	<p>
	<img class='alignleft wp-image-88 size-full' title='Biuro patalpos  Nr. 2- 2, 3, 4, 5, 6' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2018/05/IMG_5781.jpg' alt='Biuro patalpos  Nr. 2- 2, 3, 4, 5, 6' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[17]
        <p>
	<strong>Plotas:</strong> $area[17] m²
	<p>
        <strong>Kaina:</strong> $price[17] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2018/06/2-23456.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribenos-verslo-centras-klaipeda/patalpos-nr-2-2-3-4-5-6/'>Plačiau...</a>

	<hr>";
	}



	if($show[18]==1){
	$message .= 
	"
	<strong>Biuro patalpos Nr. 11, 12, 13, 14</strong>
	<p>
	<img class='alignleft wp-image-88 size-full' title='Biuro patalpos  Nr. 14' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/cn-4.jpg' alt='Biuro patalpos  Nr. 14' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[18]
        <p>
	<strong>Plotas:</strong> $area[18] m²
	<p>
        <strong>Kaina:</strong> $price[18] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/silutes_pl53_2a_14.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-15'>Plačiau...</a>

	<hr>";
	}




	if($show[19]==1){
	$message .= 
	"
	<strong>Biuro patalpos&nbsp;Nr. 15, 16, 17, 18, 19, 20, 21</strong>
	<p>
	<img class='alignleft wp-image-90 size-full' title='Biuro patalpos Nr. 15, 16, 17, 18, 19, 20, 21' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/cn5.jpg' alt='Biuro patalpos Nr. 15, 16, 17, 18, 19, 20, 21' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[19]
        <p>
	<strong>Plotas:</strong> $area[19] m²
	<p>
        <strong>Kaina:</strong> $price[19] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/silutes_pl53_2a_15ir16ir17ir18ir19ir20ir21.pdf' target='_blank' rel='noopener noreferrer'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribena-verslo-centras/biuro-patalpos-nr-16/'>Plačiau...</a>

	<hr>";
	}


	if($show[20]==1){
	$message .= 
	"
	<strong>Sandėliavimo aikštelė Nr. 1</strong>
	<p>

	<img class='wp-image-10 alignleft' title='Biuro patalpos  Nr. 2- 8' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/1.jpg' alt='„RIBENOS verslo centras” Klaipėdoje' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[20]
        <p>
	<strong>Plotas: </strong> $area[20] m²
	<p>
        <strong>Kaina:</strong> $price[20] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2019/12/Nr.-1.pdf'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribenos-verslo-centras-klaipeda/atvira-sandeliavimo-aikstele-nr-1/'>Plačiau...</a>

	<hr>";
	}




	if($show[21]==1){
	$message .= 
	"
	<strong>Sandėliavimo aikštelė Nr. 2</strong>
	<p>
	<img class='alignleft wp-image-10' title='Biuro patalpos  Nr. 2- 2, 3, 4, 5, 6' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/1.jpg' alt='„RIBENOS verslo centras” Klaipėdoje' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[21]
        <p>
	<strong>Plotas: </strong> $area[21] m²
	<p>
        <strong>Kaina:</strong> $price[21] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2019/12/Nr.-2.pdf'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribenos-verslo-centras-klaipeda/atvira-sandeliavimo-aikstele-nr-2/'>Plačiau...</a>

	<hr>";
	}



	if($show[22]==1){
	$message .= 
	"
	<strong>Dengta sandėliavimo aikštelė su garažais Nr. 3</strong>
	<p>
	<img class='alignleft wp-image-10' title='Biuro patalpos  Nr. 14' src='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2016/04/1.jpg' alt='„RIBENOS verslo centras” Klaipėdoje' width='140' height='105'>
	<p>
        <strong>Užimtumas: </strong>$date_for_show[22]
        <p>
	<strong>Plotas: </strong> $area[22] m² (d<span style='font-size: inherit'>engta aikštelė &nbsp;401 m², atvira aikštelė 460 m², 2 garažai 49 m²</span><span style='font-size: inherit'>)</span>
	<p>
        <strong>Kaina:</strong> $price[22] EUR + PVM
        <p>
	<a href='http://ribena.lt/ribenant/wp-content/uploads/sites/4/2019/12/Nr.-3.pdf'>Patalpų planas (PDF)</a>
	<p>
	<a href='http://ribena.lt/ribenant/ribenos-verslo-centras-klaipeda/degta-sandeliavimo-aikstele-nr-3/'>Plačiau...</a>";
	}


$message .= "
        <br><br>
        Daugiau NT pasiūlymų - http://ribena.lt
        <strong><br>Pagarbiai,
        <br>Rinaldis Bendikas</strong>
        <br>+370 698 00185
        <p>
        Norėdami atsisakyti naujienlaiškio, siųskite atsakymą su prierašu „Nesiųsti“.
        </body></html>";



   $subject = 'Laisvos patalpos Ribenos Verslo Centras';
   $to = array('r.bendikas@ribena.lt');
   $bcc = get_option('pm_mlist_ribena');

   $headers = array('Content-Type: text/html; charset=UTF-8');
   $headers[] = 'From: Ribena NT <info@ribena.lt>';
   $headers[] = 'Bcc:'.$bcc;
   $headers[] = 'x-smtpapi-to: info@ribena.lt';

   //add_filter('wp_mail_content_type', 'set_html_content_type');

   $mail = wp_mail($to, $subject, $message, $headers, $attachments);

   //remove_filter('wp_mail_content_type', 'set_html_content_type');

   // Redirect back to settings page
   // The ?page=github corresponds to the "slug" 
   // set in the fourth parameter of add_submenu_page() above.
      $redirect_url = get_bloginfo("url") . "/wp-admin/admin.php?page=PropertyMailerRibena&sent=success";
      header("Location: ".$redirect_url);
      exit;
}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Register the menu

add_action( "admin_menu", "pm_plugin_menu_func_ribena" );

function pm_plugin_menu_func_ribena() {
    add_menu_page( 
                        "Property Mailer Ribena",               // Page title
                        "Property Mailer Ribena",               // Menu title
                        "edit_pages",       // Minimum capability (manage_options is an easy way to target Admins)
                        "PropertyMailerRibena",               // Menu slug
                        "pm_plugin_options_ribena"     // Callback that prints the markup
                    );
}

//////////////////////////////////////////////////////////////////////////////////////

// Print the markup for the page

function pm_plugin_options_ribena() {

    if ( !current_user_can( "edit_pages" ) )  {
        wp_die( __( "You do not have sufficient permissions to access this page." ) );
    }

    if ( isset($_GET['status']) && $_GET['status']=='success') { 
    ?>
        <div id="message" class="updated notice is-dismissible">
            <p><?php _e("Settings updated!", "pm-ribena-api"); ?></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php _e("Dismiss this notice.", "pm-ribena-api"); ?></span>
            </button>
        </div>
    <?php
    }

    if ( isset($_GET['sent']) && $_GET['sent']=='success') { 
    ?>
        <div id="message" class="updated notice is-dismissible">
            <p><?php _e("Email Sent!", "pm-ribena-api"); ?></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php _e("Dismiss this notice.", "pm-ribena-api"); ?></span>
            </button>
        </div>
    <?php
    }

    ?>
    <form method="post" action="<?php echo admin_url( 'admin-post.php'); ?>">

        <input type="hidden" name="action" value="update_property_mailer_settings_ribena" />

        <h3><?php _e("Mailer settings", "pm-ribena-api"); ?></h3>
        <p>
        <label><?php _e("Sending frequency: ", "pm-ribena-api"); ?>
        <?php echo get_option('pm_f_ribena');?>
        </label>
        </p>

        <p>
        <select name="pm_f_ribena">
        <option value= "none"> Don't send </option>
        <option value= "daily"> Daily </option>
        <option value= "weekly"> Weekly </option>
        <option value= "twice a month"> Twice a month </option>
        <option value= "monthly"> Monthly </option>
        </select>
        </p>


        <p>
        <label><?php _e("Sending time: ", "pm-ribena-api"); ?>
        <?php echo get_option('pm_t_ribena');?></label>
        <p>

        <select name="pm_t_ribena"><?php echo get_times(); ?></select>

        <p>
        <label><?php _e("Mailing list:", "pm-ribena-api"); ?></label>
        </p>

        <p>
        <textarea name="pm_mlist_ribena" rows="5" cols="40"><?php echo get_option('pm_mlist_ribena');?></textarea>
        </p>

        <input class="button button-primary" type="submit" value="<?php _e("Save", "pm-ribena-api"); ?>" />
        
     

    </form>

    <br>
    <form method="post" action="<?php echo admin_url( 'admin-post.php'); ?>">

        <input type="hidden" name="action" value="send_email_now_ribena" />
        <input class="button button-primary" type="submit" value="<?php _e("Send Now", "pm-ribena-api"); ?>" />

    </form>

<?php

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




add_action( 'admin_post_update_property_mailer_settings_ribena', 'property_mailer_handle_save_ribena' );
add_action( 'admin_post_send_email_now_ribena', 'send_email_ribena' );

function property_mailer_handle_save_ribena() {

    // Get the options that were sent
    $freq = (!empty($_POST["pm_f_ribena"])) ? $_POST["pm_f_ribena"] : NULL;
    $mlist = (!empty($_POST["pm_mlist_ribena"])) ? $_POST["pm_mlist_ribena"] : NULL;
    $time = (!empty($_POST["pm_t_ribena"])) ? $_POST["pm_t_ribena"] : NULL;

    // Validation would go here

    // Update the values
    update_option( "pm_f_ribena", $freq, TRUE );
    update_option("pm_mlist_ribena", $mlist, TRUE);
    update_option("pm_t_ribena", $time, TRUE);

    // Creating a schedule for event
    if ( wp_next_scheduled( "send_email_ribena" ) ) {
        $timestamp = wp_next_scheduled( "send_email_ribena" );
        wp_unschedule_event( $timestamp, "send_email_ribena" );
    }

    if (get_option("pm_f_ribena")!= "none"){
        wp_schedule_event( strtotime(get_option('pm_t_ribena'))- 60*60*3, get_option("pm_f_ribena"), "send_email_ribena" );
    }

    // Redirect back to settings page
    // The ?page=github corresponds to the "slug" 
    // set in the fourth parameter of add_submenu_page() above.
    $redirect_url = get_bloginfo("url") . "/wp-admin/admin.php?page=PropertyMailerRibena&status=success";
    header("Location: ".$redirect_url);
    exit;
}