<template>
    <div class="tabs">
      <div class="tab-2">
        <label for="tab2-1">
          <h4>Warum Visitenkarten-Online?</h4>
        </label>
        <input id="tab2-1" name="tabs-two" type="radio" checked="checked" />
        <div class="tab-content">
          <div>
            <h4>Visitenkarten erstellen – die Basis Ihrer Geschäftsausstattung</h4>
            <p>Ein Geschäftstermin ohne Visitenkartentausch? Unvorstellbar. Visitenkarten sind noch immer eines der wichtigsten Werbemittel. 
                Nutzen Sie Ihre Karte, um sich und Ihr Unternehmen vom ersten Aufeinandertreffen an professionell zu präsentieren. 
                Ein Blick auf Vorder- und Rückseite und in wenigen Sekunden entscheidet sich, welchen Eindruck Ihr Kunde von Ihnen und Ihrer Firma hat. 
                Das Gute: Sie können diesen ersten Eindruck selbst steuern! Entscheidend sind Material und Design. Schließlich muss Ihre Karte – z. B. 
                auf einer Messe oder bei einem geschäftlichen Event – aus einer Vielzahl von Kärtchen hervorstechen und beim Empfänger dauerhaft 
                in Erinnerung bleiben. Von der klassischen Visitenkarte bis hin zur Visitenkarte mit Klapp- oder Aufkleber-Funktion – allesamt erhältlich in 
                verschiedenen Materialen, Papierstärken und mit Veredelungen: Online-Visitenkarten bietet Ihnen für die unterschiedlichsten Wünsche eine 
                breite Palette an Möglichkeiten zum Visitenkarten drucken und zum Downlaod an.</p>
          </div>
          <img class="vcard" src="../../assets/visitenkarten.png" />
        </div>
      </div>
      <div class="tab-2 t3">
        <label for="tab2-2">
          <h4>Unsere Preise</h4>
        </label>
        <input id="tab2-2" name="tabs-two" type="radio" />
        <Pricing></Pricing>
      </div>
      <div class="tab-2">
        <label for="tab2-3">
          <h4>Unser Editor</h4>
        </label>
        <input id="tab2-3" name="tabs-two" type="radio" />
        <div>
          <h4>Sofort starten</h4>
          <p>Verlieren Sie keine Zeit! Bringen Sie noch heute Ihr Geschäft auf eine neue Ebene und werden so zum Erfolgsmensch. Mit unserem Editor erstellen Sie simpel wie professionell Ihren neuen Erfolgsausweis. Geizen Sie nicht mit Ihren USP´s #selflove.</p>
          <h5>Ihr Visitenkarten-Online Team</h5>
          <a
            href="/#/designcard"
            class="btn-secondary btn"
            style="margin-top: 20px"
          >Jetzt zum Editor</a>
        </div>
      </div>
    </div>
    
</template>

<script>
import Pricing from './Pricing.vue'
export default {
    components: {
        Pricing
    }
}
</script>

<style scoped>
    .tabs {
  display: -webkit-flex;
  display: -moz-flex;
  display: flex;
  justify-content: center;
  width: 80%;
  -webkit-flex-wrap: wrap;
  -moz-flex-wrap: wrap;
  flex-wrap: wrap;
  margin: 0 10%;
  overflow: hidden;
}
.tabs [class^="tab"] label,
.tabs [class*=" tab"] label {
  color: #efedef;
  cursor: pointer;
  display: block;
  font-size: 1.1em;
  font-weight: 300;
  line-height: 1em;
  padding: 0.5rem 0;
  text-align: center;
}
.tabs [class^="tab"] [type="radio"],
.tabs [class*=" tab"] [type="radio"] {
  border-bottom: 3px solid rgba(239, 237, 239, 0.5);
  cursor: pointer;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  display: block;
  width: 100%;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.tabs [class^="tab"] [type="radio"]:hover,
.tabs [class^="tab"] [type="radio"]:focus,
.tabs [class*=" tab"] [type="radio"]:hover,
.tabs [class*=" tab"] [type="radio"]:focus {
  border-bottom: 3px solid #41b883;
}
.tabs [class^="tab"] [type="radio"]:checked,
.tabs [class*=" tab"] [type="radio"]:checked {
  border-bottom: 5px solid #41b883;
}
.tabs [class^="tab"] [type="radio"]:checked + div,
.tabs [class*=" tab"] [type="radio"]:checked + div {
  opacity: 1;
}
.tabs [class^="tab"] [type="radio"] + div,
.tabs [class*=" tab"] [type="radio"] + div {
  display: block;
  opacity: 0;
  padding: 2rem 0;
  width: 90%;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.tabs .tab-2 {
  width: 33%;
}
.tabs .tab-2 [type="radio"] + div {
  width: 300%;
  margin-left: 200%;
}
.tabs .tab-2 [type="radio"]:checked + div {
  margin-left: 0;
}
.tabs .tab-2:last-child [type="radio"] + div {
  margin-left: 100%;
}
.tabs .tab-2:last-child [type="radio"]:checked + div {
  margin-left: -200%;
}
.tabs .t3 [type="radio"]:checked + div {
  margin-left: -100%;
}

.tab-content {
  display: flex !important;
}

.vcard {
  width: 400px;
  margin-top: -30px;
}
</style>