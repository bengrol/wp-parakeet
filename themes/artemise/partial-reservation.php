<?php
$url = "https://www.misterbooking.com/booking_engine/module_booking_engine/index.php?"
?>
<div class="resa-container" >
    <span class="glyphicon glyphicon-remove" id="resa-container-close"></span>
    <form name="formPicker" id="formPicker"
          action="<?=$url ?>"
          method="get" target="_blank">

        <input type="hidden" name="id_etab" id="HotelID" value="<?= getHotelId(); ?>">
        <input type="hidden" name="language" id="idLanguage" value="<?= getCurrentLang() ?>">
        <input type="hidden" name="Template" value="Template">
        <table border="0" cellpadding="3" cellspacing="3" align="center">
            <tbody>
                <tr>
                    <td id="resaMessageTd" align="center" colspan="2"></td>
                </tr>
                <tr>
                    <td height="20" width="150"><?php _e('Arrivee', 'artemise'); ?>:</td>
                    <td width="200">
                        <input style="width: 93.1818182468414px; background-color: white;" type="text" readonly="" size="13" id="tdate" name="date_deb" onclick="displayDatePicker('date_deb', false, 'dmy', '/');" >
                        
                    </td>
                </tr>
                <tr>
                    <td><?php _e('Nuits', 'artemise'); ?>:</td>
                    <td>
                        <select id="nbNight" name="nb_nuit">
<?php
for ($i = 1; $i <= 30; $i++) {
    echo '<option value="' . $i . '">' . $i . '</option>';
}
?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><?php _e('Nb personne', 'artemise'); ?>:</td>
                    <td>
                        <select id="nbPerson" name="nb_adulte">
<?php
for ($i = 1; $i <= 10; $i++) {
    echo '<option value="' . $i . '">' . $i . '</option>';
}
?>
                        </select>
                    </td>
                </tr>
                <tr >
                    <td align="center" colspan="2"> <input id="goBook"  type="submit" value="<?php _e('Reserver', 'artemise'); ?>"></td>
                    
                    
                </tr >
          
            </tbody></table>
    </form>
</div>
