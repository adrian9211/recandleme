function deleteUser(user, id) {
    var msg = "Are you sure you want to remove the user " + user + "?\n This action is permanent and cannot be undone.";
    if (confirm(msg) == true) {
        location.href = "admin_delete_user.php?id=" + id;     
    }
    else { 
        location.href = "adminusers.php";                
    }
}

function deleteProduct(id, itemname){
    var msg = "Are you sure you want to delete " + itemname + "?\n This action is permanent and cannot be undone.";
    if (confirm(msg) == true){
        location.href = "admin_delete_product.php?id=" + id;
    }
    else {
        location.href = "adminmanageproducts.php";
    }
}

function deleteScent(id, itemname){
    var msg = "Are you sure you want to delete " + itemname + "?\n This action is permanent and cannot be undone.";
    if (confirm(msg) == true){
        location.href = "admin_delete_scent.php?id=" + id;
    }
    else {
        location.href = "adminmanagescents.php";
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

function adminSettings() {
    var msg = "Are you sure you want to change your site settings?";
    if(confirm(msg) == true) {
        return;
    }
    else {
        location.href="adminsettings.php";
    }
}

function deleteContact(id){
    var msg = "Are you sure you want to delete this contact message?\n You will not be able to undo this action.";
    if(confirm(msg) == true) {
        location.href="admin_delete_contact.php?id=" + id;
    }
    else {
        location.href="admincontact.php";
    }
}

