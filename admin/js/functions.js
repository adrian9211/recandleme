function deleteUser(user, id) {
    var msg = "Are you sure you want to remove the user " + user + "?\n This action is permanent and cannot be undone.";
    if (confirm(msg) == true) {
        location.href = "admin_delete_user.php?id=" + id;     
    }
    else { 
        location.href = "adminusers.php";                
    }
}

function userAdmin(user, id, admin) {
    if (admin == 1) {
        var msg = "Are you sure you want to remove administrator privileges from " + user + "?\n This will revoke their access to the admin panel, and all other administrative privileges.";
        if (confirm(msg) == true) {
            location.href = "admin_user_admin.php?id=" + id;
        }
        else {
            location.href = "adminusers.php";
        }
    }
    else if (admin != 1) {
        var msg = "Are you sure you want to make " + user + " an administrator?\n This will give them access to the admin panel and all other\n administrative privileges.";
        if (confirm(msg) == true) {
            location.href = "admin_user_admin.php?id=" + id;
        }
        else {
            location.href = "adminusers.php";
        }        
    }
    else {
        alert ("Error, please try again");
    }
}

function adminEmail(email) {
    var msg = "Are you sure you want to change the sites email address to " + email + "?\n This will only affect new emails, existing emails will have to be \nforwarded manually to the new address.";
    if(confirm(msg) == true) {
        location.href="adminsettings.php?webmail=" + email;
    }
    else {
        location.href="adminsettings.php";
    }
}