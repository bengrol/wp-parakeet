<?php

function scpi_first_panel_content($simulationValues){
    ?>

    <div class="col-md-6 form-group">
        <label for="simualtion[message_name]">Nom <span>*</span> </label>
        <input type="text" name="simualtion[message_name]" required
               minlength="3"
               value="<?= $simulationValues['message_name'] ?>">
    </div>
    <div class="col-md-6 form-group">
        <label for="simualtion[message_firstname]">Prenom</label>
        <input type="text" name="simualtion[message_firstname]" minlength="3"
               value="<?= $simulationValues['message_firstname'] ?>">
    </div>
    <div class="col-md-6 form-group">
        <label for="simualtion[message_phone]">Téléphone <span>*</span></label>
        <input type="text" name="simualtion[message_phone]" required
               minlength="10"
               value="<?= $simulationValues['message_phone'] ?>">
    </div>
    <div class="col-md-6 form-group">
        <label for="simualtion[message_email]">Email <span>*</span></label>
        <input type="email" required name="simualtion[message_email]"
               value="<?= $simulationValues['message_email']; ?>">
        <input type="hidden"  name="submitted" value="submitted">
    </div>

<?php
}

function scpi_second_panel_content($simulationValues){
    ?>
    <div class="col-md-12">
        <label for="simualtion[montant]">Quel montant ou effort d'épargne mensuel pensez vous investir ?<span>*</span></label>
        <input required type="number"  value="<?= $simulationValues['montant'] ?>"
               name="simualtion[montant]" /> Euros

    </div>

    <div class="col-md-12 ">
        <div class="form-group">
            <label>Comment pensez vous investir ?</label>

            <div class="ligne-form-simulation">
                <label for="simualtion[moyen_invest]">Cash <span>*</span></label>
                <input  type="radio" value="cash" name="simualtion[moyen_invest]" class="simualtion-invest-moyen cash"/>
            </div>
            <div class="ligne-form-simulation">
                <label for="simualtion[moyen_invest]">Crédit <span>*</span></label>
                <input  type="radio" value="credit" name="simualtion[moyen_invest]" class="simualtion-invest-moyen credit"/>
            </div>
        </div>
    </div>

    <div class="col-md-12 simualtion-credit-duree" style="display: none">
        <label for="simualtion[duree]">Durée </label><br>
        <input type="number" min="0" value="<?= $simulationValues['duree'] ?>" name="simualtion[duree]" /> an(s)
    </div>

    <?php
}
function scpi_third_panel_content($simulationValues){
    ?>


    <h5>Nous souhaiterions connaitre votre situation fiscale pour vous
        proposer le produit le plus personnalisé</h5>
    <div class="col-md-12">
        <div class="ligne-form-simulation">
            <label>Célibataire </label><input type="radio" value="celibataire" required name="simualtion[situation_fam]" >
        </div>
        <div class="ligne-form-simulation">
            <label>Marié-Pacsé </label><input type="radio" value="marie/pacse" required name="simualtion[situation_fam]" >
        </div>


    </div>

    <div class="col-md-12 ligne-form-simulation"><label for="message_human">nombre de parts fiscales <span>*</span></label><br>
        <input type="number" step="0.5" name="simualtion[nb_part_fiscales]"></div>

    <div class="col-md-12 ligne-form-simulation"><label for="message_human">revenus du foyer <span>*</span></label><br>
        <input  type="number"  name="simualtion[revenu_foyer]"></div>

    <?php
}