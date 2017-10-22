function ParamShow(id, chauff, aller, retour, motif, etat) {
    "use strict";
    document.getElementById(chauff).checked = true;
    document.getElementById('da').value = aller;
    document.getElementById('dr').value = retour;
    document.getElementById('mt').value = motif;
    document.getElementById('id').value = id;
    document.getElementById('submit').textContent = "Modifier";
    document.getElementById('submit').setAttribute("name", "modify");
    document.getElementById('delete').textContent = "Supprimer";
    document.getElementById('delete').setAttribute("name", "delete");
    document.getElementById('submit').style.width = "35%";
    document.getElementById('delete').style.display = "inline";
    
    if (etat !== "En attente") {
        document.getElementById('yes').setAttribute("disabled","");
        document.getElementById('no').setAttribute("disabled","");
        document.getElementById('da').setAttribute("readonly","");
        document.getElementById('dr').setAttribute("readonly","");
        document.getElementById('mt').setAttribute("readonly","");
        document.getElementById('id').setAttribute("readonly","");
        document.getElementById('submit').setAttribute("disabled","");
        document.getElementById('delete').setAttribute("disabled","");
    } else {
        document.getElementById('yes').removeAttribute("disabled");
        document.getElementById('no').removeAttribute("disabled");
        document.getElementById('da').removeAttribute("readonly");
        document.getElementById('dr').removeAttribute("readonly");
        document.getElementById('mt').removeAttribute("readonly");
        document.getElementById('id').removeAttribute("readonly");
        document.getElementById('submit').removeAttribute("disabled");
        document.getElementById('delete').removeAttribute("disabled");
    }
}

function ParamShowCow(id, chauff, aller, retour, motif, etat) {
    "use strict";
    document.getElementById(chauff).checked = true;
    document.getElementById('da').value = aller;
    document.getElementById('dr').value = retour;
    document.getElementById('mt').value = motif;
    document.getElementById('id').value = id;
    document.getElementById('submit').textContent = "Accepter";
    document.getElementById('submit').setAttribute("name", "accept");
    document.getElementById('delete').textContent = "Refuser";
    document.getElementById('delete').setAttribute("name", "refuse");
    document.getElementById('submit').style.width = "35%";
    document.getElementById('delete').style.display = "inline";
    document.getElementById('yes').setAttribute("disabled","");
    document.getElementById('no').setAttribute("disabled","");
    document.getElementById('da').setAttribute("readonly","");
    document.getElementById('dr').setAttribute("readonly","");
    document.getElementById('mt').setAttribute("readonly","");
    if (etat !== "En attente") {
        document.getElementById('submit').setAttribute("disabled","");
        document.getElementById('delete').setAttribute("disabled","");
    } else {
        document.getElementById('submit').removeAttribute("disabled");
        document.getElementById('delete').removeAttribute("disabled");
    }
}

function ParamShowWor(id, chauff, aller, retour, motif, etat) {
    "use strict";
    document.getElementById(chauff).checked = true;
    document.getElementById('da').value = aller;
    document.getElementById('dr').value = retour;
    document.getElementById('mt').value = motif;
    document.getElementById('id').value = id;
    //document.getElementById('submit').style.display = "none";
    document.getElementById('yes').setAttribute("disabled","");
    document.getElementById('no').setAttribute("disabled","");
    document.getElementById('da').setAttribute("readonly","");
    document.getElementById('dr').setAttribute("readonly","");
    document.getElementById('mt').setAttribute("readonly","");
    document.getElementById('submit').setAttribute("disabled","");
}

function ReservationShow(chauffeur, vehicule, date_a, k_aller, date_r, k_retour, dest) {
    "use strict";
    if (vehicule === "") {
        document.getElementById('cars').removeAttribute("disabled");
        document.getElementById('drivers').removeAttribute("disabled");
        if (document.getElementById('yes').checked === true) {
            document.getElementById('drivers').setAttribute("required", "");
        } else {
            document.getElementById('drivers').removeAttribute("required");
        }
        document.getElementById('ds').removeAttribute("readonly");
        document.getElementById('dts').removeAttribute("readonly");
        document.getElementById('kms').removeAttribute("readonly");
        document.getElementById('vls').removeAttribute("disabled");
        document.getElementById('cars').value = document.getElementById('vehicule').value;
        document.getElementById('drivers').value = document.getElementById('driver').value;
        document.getElementById('ds').value = "";
        document.getElementById('dts').value = "";
        document.getElementById('kms').value = "";
        document.getElementById('de').value = "";
        document.getElementById('kme').value = "";
        document.getElementById('de').setAttribute("readonly","");
        document.getElementById('kme').setAttribute("readonly","");
        document.getElementById('vle').setAttribute("disabled","");
    } else {
        document.getElementById('cars').value = document.getElementById('vehicule' + vehicule).value;
        document.getElementById('drivers').value = document.getElementById('driver' + chauffeur).value;
        document.getElementById('ds').value = date_a;
        document.getElementById('dts').value = dest;
        document.getElementById('kms').value = k_aller;
        document.getElementById('cars').setAttribute("disabled","");
        document.getElementById('drivers').setAttribute("disabled","");
        document.getElementById('ds').setAttribute("readonly","");
        document.getElementById('dts').setAttribute("readonly","");
        document.getElementById('kms').setAttribute("readonly","");
        document.getElementById('vls').setAttribute("disabled","");
        if (k_retour === "") {
            document.getElementById('de').removeAttribute("readonly");
            document.getElementById('kme').removeAttribute("readonly");
            document.getElementById('vle').removeAttribute("disabled");
            document.getElementById('de').value = "";
            document.getElementById('kme').value = "";
        } else {
            document.getElementById('de').value = date_r;
            document.getElementById('kme').value = k_retour;
            document.getElementById('de').setAttribute("readonly","");
            document.getElementById('kme').setAttribute("readonly","");
            document.getElementById('vle').setAttribute("disabled","");
            
        }
        
    }
}

function VehiculeShow(nom, marque, mat, km, etat) {
    "use strict";
    document.getElementById('vn').value = nom;
    document.getElementById('vm').value = marque;
    document.getElementById('vi').value = mat;
    document.getElementById('vi').setAttribute("readonly","");
    document.getElementById('vk').value = km;
    document.getElementById('ve').value = document.getElementById(etat).value;
    document.getElementById('submit').textContent = "Modifier";
    document.getElementById('submit').setAttribute("name", "modify");
    document.getElementById('submit').style.width = "35%";
    document.getElementById('delete').style.display = "inline";
}

function ChauffeurShow(nom, prenom, mat, etat) {
    "use strict";
    document.getElementById('cn').value = nom;
    document.getElementById('cp').value = prenom;
    document.getElementById('cm').value = mat;
    document.getElementById('cm').setAttribute("readonly","");
    document.getElementById('ce').value = document.getElementById(etat).value;
    document.getElementById('submit').textContent = "Modifier";
    document.getElementById('submit').setAttribute("name", "modify");
    document.getElementById('submit').style.width = "35%";
    document.getElementById('delete').style.display = "inline";
}
        
function DateMin(e, min) {
    "use strict";
    e.setAttribute("min", min.value);
}