const AJAX_SUCCESS = 1;
const AJAX_FAILURE = 2;
const AJAX_ERROR = 3;
//Configuration des lancements d'animations
// /!\Attention là du est dans du js pas dans du php ;)/!\
//En gros pour lancer une anim on appelera $ANIM_BASE_URL 
//avec un argument en POST, dans la variable "code" (cf. ajax_utils.js)
//Tu peux tout changer la dedans pour que ca marche avec ton serveur, c'est même
//ok si tu pousses sur le git. Tant que tu gardes le système base + constante
const ANIM_BASE_URL = 'http://127.0.0.1:8080/animations.py';
//constantes de code
const ANIM_CODE_CHECK_UP = "checkup";
const ANIM_CODE_DIAGNOSTIC_DROGUE = "diagnostic_drogue";
const ANIM_CODE_DIAGNOSTIC_MALADIE = "diagnostic_maladie";
const ANIM_CODE_DIAGNOSTIC_IMAGERIE = "diagnostic_imagerie";
const ANIM_CODE_SOINS_ANTIDOULEURS = "soins_antidouleurs";
const ANIM_CODE_SOINS_ANTIBIOTIQUES = "soins_antibiotiques";
const ANIM_CODE_SOINS_INHALATIONS = "soins_inhalations";
const ANIM_CODE_SOINS_PRISE_SANG = "soins_prise_sang";
const ANIM_CODE_CHIR_DESINFECTION = "chir_desinfection";
const ANIM_CODE_CHIR_PRELEVEMENTS = "soins_prelevements";
const ANIM_CODE_ANESTHESIE = "soins_anesthesie";
const ANIM_CODE_SPERMOGRAMME = "spermogramme";
const ANIM_CODE_TEST_GROSSESSE = "test_grossesse";

//La méthode de lancement de l'animation
function play_anim(code_anim) {
    $(document).ready(function(){
        var input = {code: code_anim};
        $.post(ANIM_BASE_URL,input, function(){});
    });
}