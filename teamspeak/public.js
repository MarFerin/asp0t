var pass = "aspot_22";
function create(){
    if(validation()){
        $('#loading').show();
        $('#create').prop('disabled', true);
        var sendJson = {"Passkey":pass, "ServerName":$('#server-name').val(), "Slots":$('#slots').val(),"Domain":$('#domain-name').val(),
                "Subdomain":$('#server-subdomain').val(), "TeamspeakStyle":$('#teamspeak-style').val(), "ClientPerms":$('#client-permissions').is(':checked'), 
                "ChannelClientPerms":$('#channel-client-permissions').is(':checked')};
        $.ajax({
            type: "POST",
            url: "/ajax.php",
            dataType: "json",
            data: {createTeamspeak:sendJson},
            success: function(data) {
                if(data["Error"]==0){
                    var dataRead = data["Response"];
                    $('#url-to-copy').val('ts3server://'+dataRead["URL"]+'?token='+dataRead["token"]);
                    $("#Connection").show();
                    $('#loading').hide();
                }
                else{
                    var errorMessage = data["Response"];
                    $('#loading').hide();
                }
            }
        });
    }
}
function updateDNS(){
    var sendJson = {"Passkey":pass, "cSubdomain":$('#current-dns').val(), "nSubdomain":$('#new-dns').val(), "cDomain":$('#cdomain-name').val(), "nDomain":$('#ndomain-name').val()};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "json",
        data: {updateTSDNS:sendJson},
        success: function(data) {
            if(data["Error"]==0){
                swal({
                    title: "Domain has been changed!",
                    type: "success",
                    allowOutsideClick: true,
                    showConfirmButton: true
                },
                function(){
                    checkcurrentTSDNS();
                    checknewTSDNS();
                });
            }
            else{
                swal({
                    title: "Something went wrong!",
                    type: "error",
                    allowOutsideClick: true,
                    showConfirmButton: true
                });
            }
        }
    });
}
function validation(){
    var returnvalue = true;
    if($('#server-name').val()==""){
        document.getElementById("server-name").setCustomValidity("Invalid Name.");
        document.getElementById("nameError").innerHTML = "*Name cannot be empty.";
        returnvalue = false;
    }
    else if($('#server-name').val().length>30){
        document.getElementById("server-name").setCustomValidity("Invalid Name.");
        document.getElementById("nameError").innerHTML = "*Name is too long.";
        returnvalue = false;
    }
    if($('#server-subdomain').val()==""){
        document.getElementById("server-subdomain").setCustomValidity("Invalid Subdomain.");
        document.getElementById("domainError").innerHTML = "*Subdomain cannot be empty.";
        returnvalue = false;
    }
    else if($('#server-name').val().length>30){
        document.getElementById("server-subdomain").setCustomValidity("Invalid Subdomain.");
        document.getElementById("domainError").innerHTML = "*Subdomain too long.";
        returnvalue = false;
    }
    return returnvalue;
}
function evalidation(){
    var returnvalue = true;
    if($('#eserver-name').val()==""){
        document.getElementById("eserver-name").setCustomValidity("Invalid Name.");
        document.getElementById("enameError").innerHTML = "*Name cannot be empty.";
        returnvalue = false;
    }
    else if($('#eserver-name').val().length>30){
        document.getElementById("eserver-name").setCustomValidity("Invalid Name.");
        document.getElementById("enameError").innerHTML = "*Name is too long.";
        returnvalue = false;
    }
    if($('#eserver-subdomain').val()==""){
        document.getElementById("eserver-subdomain").setCustomValidity("Invalid Subdomain.");
        document.getElementById("edomainError").innerHTML = "*Subdomain cannot be empty.";
        returnvalue = false;
    }
    else if($('#eserver-name').val().length>30){
        document.getElementById("eserver-subdomain").setCustomValidity("Invalid Subdomain.");
        document.getElementById("edomainError").innerHTML = "*Subdomain too long.";
        returnvalue = false;
    }
    return returnvalue;
}
function clearValidity(){
    document.getElementById("server-subdomain").setCustomValidity("");
    document.getElementById("domainError").innerHTML = "";
}
function eclearValidity(){
    document.getElementById("eserver-subdomain").setCustomValidity("");
    document.getElementById("edomainError").innerHTML = "";
}
function checkTSDNS(){
    if($('#server-subdomain').val()==""){
        document.getElementById("server-subdomain").setCustomValidity("Invalid Subdomain.");
        document.getElementById("domainError").innerHTML = "*Subdomain cannot be empty.";
        return 1;
    }
    var sendJson = {"Subdomain":$('#server-subdomain').val(),"Domain":$('#domain-name').val()};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "json",
        data: {checkTSDNS:sendJson},
        success: function(data) {
            if(data["Error"]==0){
                document.getElementById("server-subdomain").setCustomValidity("");
                document.getElementById("domainError").innerHTML = "";
            }
            if(data["Error"]==2){
                document.getElementById("server-subdomain").setCustomValidity("Invalid Subdomain.");
                document.getElementById("domainError").innerHTML = "*Invalid Subdomain";
            }
            else if(data["Error"]==3){
                document.getElementById("server-subdomain").setCustomValidity("Subdomain Taken.");
                document.getElementById("domainError").innerHTML = "*Subdomain Taken.";
            }
            return data["Error"];
        }
    });
}
function echeckTSDNS(){
    if($('#eserver-subdomain').val()==""){
        document.getElementById("eserver-subdomain").setCustomValidity("Invalid Subdomain.");
        document.getElementById("edomainError").innerHTML = "*Subdomain cannot be empty.";
        return 1;
    }
    var sendJson = {"Subdomain":$('#eserver-subdomain').val(),"Domain":$('#edomain-name').val()};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "json",
        data: {checkTSDNS:sendJson},
        success: function(data) {
            if(data["Error"]==0){
                document.getElementById("eserver-subdomain").setCustomValidity("");
                document.getElementById("edomainError").innerHTML = "";
            }
            if(data["Error"]==2){
                document.getElementById("eserver-subdomain").setCustomValidity("Invalid Subdomain.");
                document.getElementById("edomainError").innerHTML = "*Invalid Subdomain";
            }
            else if(data["Error"]==3){
                document.getElementById("eserver-subdomain").setCustomValidity("Subdomain Taken.");
                document.getElementById("edomainError").innerHTML = "*Subdomain Taken.";
            }
            return data["Error"];
        }
    });
}
function checkcurrentTSDNS(){
    if($('#current-dns').val()==""){
        document.getElementById("current-dns").setCustomValidity("Invalid Subdomain.");
        document.getElementById("cdnsError").innerHTML = "*Subdomain cannot be empty.";
        return 1;
    }
    var sendJson = {"Subdomain":$('#current-dns').val(),"Domain":$('#cdomain-name').val()};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "json",
        data: {checkTSDNS:sendJson},
        success: function(data) {
            if(data["Error"]==0){
                document.getElementById("current-dns").setCustomValidity("Subdomain Does Not Exist.");
                document.getElementById("cdnsError").innerHTML = "*Subdomain Does Not Exist.";
            }
            if(data["Error"]==2){
                document.getElementById("current-dns").setCustomValidity("Invalid Subdomain.");
                document.getElementById("cdnsError").innerHTML = "*Invalid Subdomain.";
            }
            else if(data["Error"]==3){
                document.getElementById("current-dns").setCustomValidity("");
                document.getElementById("cdnsError").innerHTML = "";
            }
            return data["Error"];
        }
    });
}
function checknewTSDNS(){
    if($('#new-dns').val()==""){
        document.getElementById("new-dns").setCustomValidity("Invalid Subdomain.");
        document.getElementById("ndnsError").innerHTML = "*Subdomain cannot be empty.";
        return 1;
    }
    var sendJson = {"Subdomain":$('#new-dns').val(),"Domain":$('#ndomain-name').val()};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "json",
        data: {checkTSDNS:sendJson},
        success: function(data) {
            if(data["Error"]==0){
                document.getElementById("new-dns").setCustomValidity("");
                document.getElementById("ndnsError").innerHTML = "";
            }
            if(data["Error"]==2){
                document.getElementById("new-dns").setCustomValidity("Invalid Subdomain.");
                document.getElementById("ndnsError").innerHTML = "*Invalid Subdomain";
            }
            else if(data["Error"]==3){
                document.getElementById("new-dns").setCustomValidity("Subdomain Taken.");
                document.getElementById("ndnsError").innerHTML = "*Subdomain Taken.";
            }
            return data["Error"];
        }
    });
}
function copyURL() {
    var range     = document.createRange(),
    selection;
    if (window.clipboardData) {
        window.clipboardData.setData("Text", $('#url-to-copy').val());        
    } else {
        var tmpElem = $('<div>');
        tmpElem.css({
        position: "absolute",
        left:     "-1000px",
        top:      "-1000px",
        });
        // Add the input value to the temp element.
        tmpElem.text($('#url-to-copy').val());
        $("body").append(tmpElem);
        // Select temp element.
        range.selectNodeContents(tmpElem.get(0));
        selection = window.getSelection ();
        selection.removeAllRanges ();
        selection.addRange (range);
        document.execCommand ("copy", false, null);
        tmpElem.remove();
    }
}
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        evt.target.setCustomValidity("Invalid field.");
        setTimeout(setValid, 400);
        return false;
    }
    setValid();
    return true;
}
function checkOverflow(evt){
    if(parseInt(evt.target.value)>500){
        evt.target.value = 500;
        evt.target.setCustomValidity("Invalid field.");
        setTimeout(setValid, 400);
    }
}
function setValid(){
    document.getElementById("slots").setCustomValidity("");
    document.getElementById("eslots").setCustomValidity("");
}