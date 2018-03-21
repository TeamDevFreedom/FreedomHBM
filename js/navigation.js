var AJAX_SUCCESS = 1;
var AJAX_FAILURE = 2;
var AJAX_ERROR = 3;
//Configuration des lancements d'animations
// /!\Attention là du est dans du js pas dans du php ;)/!\
//En gros pour lancer une anim on appelera $ANIM_BASE_URL + une constante de code
var ANIM_BASE_URL = 'http://127.0.0.1:8080/';
//constantes de code : duration est en millisecondes
var ANIM_CODE_CHECK_UP_CALME = {code :"checkup", duration: "2000"};
var ANIM_CODE_CHECK_UP_AGITE = {code :"checkup", duration: "2000"};
var ANIM_CODE_CHECK_UP_TRES_AGITE = {code :"checkup", duration: "2000"};
var ANIM_CODE_DIAGNOSTIC_DROGUE = {code :"diagnostic_drogue", duration: "2000"};
var ANIM_CODE_DIAGNOSTIC_MALADIE = {code :"diagnostic_maladie", duration: "2000"};
var ANIM_CODE_DIAGNOSTIC_IMAGERIE = {code :"diagnostic_imagerie", duration: "2000"};
var ANIM_CODE_SOINS_ANTIDOULEURS = {code :"soins_antidouleurs", duration: "2000"};
var ANIM_CODE_SOINS_ANTIBIOTIQUES = {code :"soins_antibiotiques", duration: "2000"};
var ANIM_CODE_SOINS_INHALATIONS = {code :"soins_inhalations", duration: "2000"};
var ANIM_CODE_SOINS_PRISE_SANG = {code :"soins_prise_sang", duration: "2000"};
var ANIM_CODE_CHIR_DESINFECTION = {code :"chir_desinfection", duration: "2000"};
var ANIM_CODE_CHIR_PRELEVEMENTS = {code :"soins_prelevements", duration: "2000"};
var ANIM_CODE_ANESTHESIE = {code :"soins_anesthesie", duration: "2000"};
var ANIM_CODE_SPERMOGRAMME = {code :"spermogramme", duration: "2000"};
var ANIM_CODE_TEST_GROSSESSE = {code :"test_grossesse", duration: "2000"};
var ANIM_CODE_PRELEVEMENT_ADN = {code :"prelevement_adn", duration: "2000"};

function navigate(url){
    window.location.href = url;
}

function navigateAnimationNoResult(animation){
    var currentUrl = window.location.href;
    navigateAnimation("no_result.php?source_url="+currentUrl, animation);
}

function navigateAnimation(url, animation){
    navigate("loading.php?return_url="+url+"&wait="+animation.duration+"&code="+animation.code);
}